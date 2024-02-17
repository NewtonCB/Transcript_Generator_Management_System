<?php
// Database connection
include('../db_connection.php');

// Function to calculate grade
function calculateGrade($ca, $fe) {
    $total = $ca + $fe;
    if ($total >= 70) return 'A';
    if ($total >= 60) return 'B+';
    if ($total >= 50) return 'B';
    if ($total >= 40) return 'C';
    if ($total >= 30) return 'D';
    return 'F';
}

// Function to get grade point
function getGradePoint($ca, $fe) {
    $total = $ca + $fe;
    if ($total >= 70) return 5;
    if ($total >= 60) return 4;
    if ($total >= 50) return 3;
    if ($total >= 40) return 2;
    if ($total >= 30) return 1;
    return 0;
}

// Function to calculate GPA
function calculateGPA($results) {
    $total_credit = 0;
    $total_grade_points = 0;
    foreach ($results as $result) {
        $credit = $result['credit'];
        $grade_point = getGradePoint($result['CA'], $result['FE']);
        $total_credit += $credit;
        $total_grade_points += ($credit * $grade_point);
    }
    return $total_credit > 0 ? round($total_grade_points / $total_credit, 2) : 0;
}

// Function to calculate overall GPA
function calculateOverallGPA($studentResults) {
    $semesters = $studentResults['results'];
    $sumOfGPAs = 0;
    $totalSemesters = count($semesters);

    foreach ($semesters as $semester) {
        $sumOfGPAs += calculateGPA([$semester]);
    }

    $overallGPA = $totalSemesters > 0 ? $sumOfGPAs / $totalSemesters : 0;

    return round($overallGPA, 2);
}


function stateAward($overall_gpa) {
  if ($overall_gpa >= 4) return 'FIRST CLASS';
  if ($overall_gpa >=3) return 'SECOND CLASS';
  if ($overall_gpa >= 2) return 'LOWER SECOND CLASS';
  return 'Fail';
}



// Function to fetch student results and name
function fetchStudentResultsAndName($con, $regNo) {
    $studentSql = "SELECT surname, givenNames, regNo, birthDate, admDate, grdDate, gender  FROM student WHERE regNo = ?";
    $stmtStudent = mysqli_prepare($con, $studentSql);
    mysqli_stmt_bind_param($stmtStudent, "s", $regNo);
    mysqli_stmt_execute($stmtStudent);
    $studentResult = mysqli_stmt_get_result($stmtStudent);
    $student = mysqli_fetch_assoc($studentResult);

    $sql = "SELECT results.*, module.modName, module.sem_id, module.credit FROM results INNER JOIN module ON results.modCode = module.modCode WHERE results.regNo = ? ORDER BY module.sem_id ASC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $regNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return ['student' => $student, 'results' => $results];
}

// Function to fetch all students
function fetchAllStudents($con) {
    $sql = "SELECT regNo, surname, givenNames FROM student ORDER BY surname ASC";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$students = fetchAllStudents($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student'])) {
    $selectedStudent = $_POST['student'];
    $studentResults = fetchStudentResultsAndName($con, $selectedStudent);
    $semesters = array();
    foreach ($studentResults['results'] as $result) {
        $sem_id = $result['sem_id'];
        $semesters[$sem_id][] = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Transcript</title>
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
        
  <body>
    <h2>Add Staff</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="username"></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"><br></td>
        </tr>
    </table>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to MySQL database
        $conn = mysqli_connect("localhost", "root", "", "tgms_db");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Escape user inputs for security
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
          // Generate a random user ID
        $user_id = rand(1000, 9999); // Generate a random integer between 1000 and 9999


        // Insert user data into table
        $sql = "INSERT INTO `user` (`username`, `password`, `user_id`) VALUES ('$username', '$password', '$user_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<alert('User added successfully!')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
    ?>



</main>



</script>
</body>
</html>
