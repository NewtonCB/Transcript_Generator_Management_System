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

// Function to fetch student results and name
function fetchStudentResultsAndName($con, $regNo) {
    $studentSql = "SELECT surname, givenNames FROM student WHERE regNo = ?";
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

if (isset($_GET['regNo'])) {
    $selectedStudentRegNo = $_GET['regNo'];

    $studentResults = fetchStudentResultsAndName($con, $selectedStudentRegNo);

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
    <title>Results</title>
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
        <span class="d-none d-lg-block"><b>Results</b></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <li>
              <a class="dropdown-item d-flex align-items-center" href="../../../index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

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

    

    <?php if (isset($studentResults)): ?>
        <div id="report">
            <h1>Name: <?= htmlspecialchars($studentResults['student']['surname'] . " " . $studentResults['student']['givenNames']) ?></h1>
            <?php foreach ($semesters as $sem_id => $semesterResults): ?>
                <div class="semester">
                    <h2>Semester <?= $sem_id ?></h2>
                    <div class="report">
                        <?php foreach ($semesterResults as $result): ?>
                            <div class="module">
                                <span><?= htmlspecialchars($result['modName']) ?></span>
                                <span><?= calculateGrade($result['CA'], $result['FE']) ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="gpa">
                            <p>GPA: <?= calculateGPA($semesterResults) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Include necessary JavaScript files -->
</body>
</html>
