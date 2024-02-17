<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $modCode = $_POST['modCode'];
    $modName = $_POST['modName'];
    $credit = $_POST['credit'];
    $sess_id = "";
    $sem_id = $_POST['sem_id'];
    $level_id = "";
    $course_id = 1;
    $dept_id = $_POST['dept_id'];

    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tgms_db";

    try {
        // Create database connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $sql = "INSERT INTO module (modCode, modName, credit, sess_id, sem_id, level_id, course_id, dept_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->execute([$modCode, $modName, $credit, $sess_id, $sem_id, $level_id, $course_id, $dept_id]);

        echo "New module added successfully";
        echo "<script>alert('New module added successfully')</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Module</title>

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
<h2>Add New Module</h2>

<form action="add_module.php" method="post">
    <label for="modCode">Module Code:</label><br>
    <input type="text" id="modCode" name="modCode" required><br>
    
    <label for="modName">Module Name:</label><br>
    <input type="text" id="modName" name="modName" required><br>
    
    <label for="credit">Credit:</label><br>
    <input type="number" id="credit" name="credit" required><br>
    
    
    <label for="sem_id">Semester ID:</label><br>
    <input type="number" id="sem_id" name="sem_id" required><br>
    
    <label for="dept_id">Department ID:</label><br>
    <input type="number" id="dept_id" name="dept_id" required><br><br>
    
    <input type="submit" value="Submit">
</form>
</main>
</body>
</html>
