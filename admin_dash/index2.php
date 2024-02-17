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
          <li>
              <a class="dropdown-item d-flex align-items-center" href="../index.php">
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
<form action="" method="post">
    <label for="student">Select Student:</label>
    <select name="student" id="student">
        <?php foreach ($students as $student): ?>
            <option value="<?= htmlspecialchars($student['regNo']) ?>"><?= htmlspecialchars($student['surname'] . " " . $student['givenNames']) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Generate Report">
</form>
        
<?php if (isset($studentResults)): ?>
    <div id="report">
        <h1>Name <?= htmlspecialchars($studentResults['student']['surname'] . " " . $studentResults['student']['givenNames']) ?></h1>
        <?php foreach ($semesters as $sem_id => $semesterResults): ?>
            <?php
            $alertType = '';
            $alertText = '';
            foreach ($semesterResults as $result) {
                if ($result['CA'] < 23) {
                    $alertType = 'retake';
                    $alertText = 'Retake';
                    break;
                } elseif ($result['FE'] < 16) {
                    $alertType = 'supp';
                    $alertText = 'Supplementary Examination Required';
                    break;
                }
            }
            ?>
            <div class="semester col-6 sm1 <?= $alertType ?>">
                <h2>Semester <?= $sem_id ?> <?= $alertText ?></h2>
                <div class="report">
                    <?php foreach ($semesterResults as $result): ?>
                        <div class="module">
                            <span><?= htmlspecialchars($result['modName']) ?></span>
                            <span><?= htmlspecialchars($result['CA']) ?></span>
                            <span><?= htmlspecialchars($result['FE']) ?></span>
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
    <button class="btn btn-success" onclick="printReport()">Print Report</button>
<?php endif; ?>

</main>

<script>
function printReport() {
    var element = document.getElementById('report');
    html2pdf().from(element).set({
        margin: 1,
        filename: 'report.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    }).save();
}
</script>
</body>
</html>
