<?php
include('../db_connection.php'); // Make sure this path is correct
session_start();

// Function to fetch all modules
function fetchModules($con) {
    $modules = [];
    $query = "SELECT modCode, modName FROM module";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $modules[$row['modCode']] = $row['modName'];
    }
    return $modules;
}

// Function to fetch scores for a given module
function fetchScoresForModule($con, $modCode) {
    $scores = [];
    $query = "SELECT s.regNo, s.surname, s.givenNames, r.CA, r.FE FROM student s LEFT JOIN results r ON s.regNo = r.regNo AND r.modCode = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $modCode);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[$row['regNo']] = $row;
    }
    return $scores;
}

// Handle form submission
if (isset($_POST['submit_scores'])) {
    $modCode = $_POST['module_code'];
    foreach ($_POST['students'] as $regNo => $scores) {
        $caScore = $scores['ca'];
        $faScore = $scores['fa'];

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
    echo "<script>alert('Scores updated successfully!');</script>";
}

$modules = fetchModules($con);
$selectedModule = isset($_POST['module_code']) ? $_POST['module_code'] : '';
$scores = $selectedModule ? fetchScoresForModule($con, $selectedModule) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Student Scores</title>
    
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
        <span class="d-none d-lg-block"><b>TRANSCRIPT MANAGEMENT</b></span>
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
              <a class="dropdown-item d-flex align-items-center" href="../index.php">
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
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item ">
    <a class="nav-link collapsed" href="register_student.php">
      <i class="bi bi-file-person-fill"></i>
      <span>Register Student</span>
    </a>
  </li><!-- End Gigs Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="upload_results.php">
      <i class="bi bi-book-fill"></i>
      <span>Upload Results</span>
    </a>
  </li><!-- End Gigs Nav -->

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="add_module.php">
      <i class="bi bi-collection-fill"></i>
      <span>Add Module</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="generate_report.php">
      <i class="bi bi-briefcase-fill"></i>
      <span>Generate Report</span>
    </a>
  </li>

  <li class="nav-item">
        <a class="nav-link collapsed" href="generate_transcript.php">
          <i class="bi bi-briefcase-fill"></i>
          <span>Generate Transcript</span>
        </a>
  </li>

  <li class="nav-item">
        <a class="nav-link collapsed" href="add_staff.php">
          <i class="bi bi-file-person-fill"></i>
          <span>Add Staff</span>
        </a>
      </li>

</ul>

</aside><!-- End Sidebar-->


<main id="main" class="main">
<div class="container">
    <h2>Add/Edit Module Results</h2>
    <form method="POST">
        <label for="module_code">Select Module:</label>
        <select name="module_code" id="module_code" onchange="this.form.submit()">
            <option value="">Select a Module</option>
            <?php foreach ($modules as $code => $name): ?>
                <option value="<?php echo $code; ?>" <?php if ($selectedModule == $code) echo 'selected'; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($selectedModule && !empty($scores)): ?>
        <form method="POST">
            <input type="hidden" name="module_code" value="<?php echo $selectedModule; ?>">
            <table>
                <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Name</th>
                        <th>CA Score (0-60)</th>
                        <th>FA Score (0-40)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scores as $regNo => $score): ?>
                        <tr>
                            <td><?php echo $score['regNo']; ?></td>
                            <td><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'. $score['surname'] . ' ' . $score['givenNames']; ?></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][ca]" value="<?php echo $score['CA'] ?? ''; ?>" min="0" max="60"></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][fa]" value="<?php echo $score['FE'] ?? ''; ?>" min="0" max="40"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <center><button type="submit" name="submit_scores" class="w-50 btn btn-sm btn-primary">Submit Scores</button></center>
        </form>
    <?php elseif ($selectedModule): ?>
        <p>No students found for this module.</p>
    <?php endif; ?>
</div>

    </main>


</body>
</html>
