<?php
// Database connection
include('../db_connection.php');

// Start session
session_start();

// Function to fetch scores for a given module with search functionality
function fetchScoresForModule($con, $modCode, $searchKeyword = '') {
    $scores = [];
    // Modified query to include search functionality
    $query = "SELECT s.regNo, s.surname, s.givenNames, r.CA, r.FE 
              FROM student s 
              LEFT JOIN results r ON s.regNo = r.regNo AND r.modCode = ?
              WHERE CONCAT(s.surname, ' ', s.givenNames) LIKE ?";
    $searchString = '%' . $searchKeyword . '%';
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $modCode, $searchString);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[$row['regNo']] = $row;
    }
    return $scores;
}

// Function to calculate grade
function calculateGrade($caint, $feint) {
    $ca = intval($caint);
    $fe = intval($feint);
    $total = $ca + $fe;
    if ($total >= 70) return 'A';
    if ($total >= 60) return 'B+';
    if ($total >= 50) return 'B';
    if ($total >= 40) return 'C';
    if ($total >= 30) return 'D';
    return 'F';
}

// Handle form submission
if (isset($_POST['submit_scores'])) {
    // Validate and process submitted scores
    $modCode = $_POST['module_code'];
    foreach ($_POST['students'] as $regNo => $scores) {
        $caScore = $scores['ca'];
        $faScore = $scores['fa'];

        // Update or insert scores into the database
        // Add your SQL queries here to update or insert scores

        $checkQuery = "SELECT * FROM results WHERE regNo = ? AND modCode = ?";
        $stmtCheck = mysqli_prepare($con, $checkQuery);
        mysqli_stmt_bind_param($stmtCheck, 'is', $regNo, $modCode);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            $updateQuery = "UPDATE results SET CA = ?, FE = ? WHERE regNo = ? AND modCode = ?";
            $stmtUpdate = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmtUpdate, 'iiis', $caScore, $faScore, $regNo, $modCode);
            mysqli_stmt_execute($stmtUpdate);
        } else {
            $insertQuery = "INSERT INTO results (regNo, modCode, CA, FE) VALUES (?, ?, ?, ?)";
            $stmtInsert = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($stmtInsert, 'isii', $regNo, $modCode, $caScore, $faScore);
            mysqli_stmt_execute($stmtInsert);
        }
    }
}

// Delete student if delete request is received
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['regNo'])) {
    $regNoToDelete = $_GET['regNo'];
    $deleteQuery = "DELETE FROM student WHERE regNo = ?";
    $stmtDelete = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmtDelete, 'i', $regNoToDelete);
    mysqli_stmt_execute($stmtDelete);
    // Redirect back to the URL with parameters
    $mod1 = 63278;
    header("Location: {$_SERVER['PHP_SELF']}?module_code={$mod1}");
    exit();
    exit();
}

// Fetch all modules from the database
function fetchModules($con) {
    $modules = [];
    $query = "SELECT modCode, modName FROM module";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $modules[$row['modCode']] = $row['modName'];
    }
    return $modules;
}

// Get the selected module code from the URL
$selectedModule = $_GET['module_code'] ?? '';

// Get search keyword from the form
$searchKeyword = isset($_POST['search_keyword']) ? $_POST['search_keyword'] : '';

// Fetch scores for the selected module with search functionality
$scores = $selectedModule ? fetchScoresForModule($con, $selectedModule, $searchKeyword) : [];

// Fetch all modules
$modules = fetchModules($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        .retake { background-color: red; color: white; }
        .supp { background-color: purple; color: white; }
    </style>

    <!-- Favicons -->
  <link href="../pictures/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index2.php" class="logo d-flex align-items-center">
        <img src="../pictures/logo.png" alt="">
        <span class="d-none d-lg-block"><b>UPLOAD RESULTS</b></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../pictures/nathan.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Nathaniel & Daniel & Nasrah</h6>
              <span>System Owner</span><br>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../../index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index2.php">
          <i class="bi bi-grid-fill"></i>
          <span>Upload Results</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item ">
        <a class="nav-link collapsed" href="register_student.php">
          <i class="bi bi-file-person-fill"></i>
          <span>Register Student</span>
        </a>
      </li><!-- End Gigs Nav -->


    </ul>

  </aside><!-- End Sidebar--> 4
  <main id="main" class="main">
  <form method="POST">
        <label for="module_code">Select Module:</label>
        <select name="module_code" id="module_code" onchange="this.form.submit()">
            <option value="">Select a Module</option>
            <?php foreach ($modules as $code => $name): ?>
                <option value="<?php echo $code; ?>" <?php if ($selectedModule == $code) echo 'selected'; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Add search functionality -->
        <label for="search_keyword">Search:</label>
        <input type="text" name="search_keyword" id="search_keyword" value="<?php echo $searchKeyword; ?>">
        <button type="submit">Search</button>

        <?php if ($selectedModule && !empty($scores)): ?>
            <!-- Display table with scores -->
            <table>
                <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Name</th>
                        <th>CA Score (0-60)</th>
                        <th>FA Score (0-40)</th>
                        <th>Grade</th> <!-- New column for grade -->
                        <th>Status</th> <!-- New column for status -->
                        <th>Action</th> <!-- New column for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scores as $regNo => $score): ?>
                        <tr>
                            <td><?php echo $score['regNo']; ?>&nbsp;&nbsp;&nbsp;</td>
                            <td><?php echo $score['surname'] . ' ' . $score['givenNames']; ?></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][ca]" value="<?php echo $score['CA'] ?? ''; ?>" min="0" max="60"></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][fa]" value="<?php echo $score['FE'] ?? ''; ?>" min="0" max="40"></td>
                            <td>
                                <?php
                                    // Calculate grade
                                    $caScore = $score['CA'] ?? 0;
                                    $faScore = $score['FE'] ?? 0;
                                    $grade = calculateGrade($caScore, $faScore);
                                    echo $grade;
                                ?>
                            </td>
                            <td>
                                <?php
                                    // Determine status based on CA and FA scores
                                    if ($caScore < 23) {
                                        echo "<span style='color: red;'>Retake</span>";
                                    } elseif ($faScore < 16) {
                                        echo "<span style='color: gray;'>Carry</span>";
                                    } else {
                                        echo "<span style='color: green;'>Pass</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <!-- Action buttons -->
                                <a href="?action=delete&regNo=<?php echo $regNo; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="submit_scores">Submit Scores</button>
        <?php elseif ($selectedModule): ?>
            <p>No students found for this module.</p>
        <?php endif; ?>
    </form>
  </main>
</body>
</html>
