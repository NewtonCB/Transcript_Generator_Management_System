<?php
include('../db_connection.php');
session_start();

$Name='';
$regNo='';
$Surname='';

if(isset($_POST['search'])){

$search_term =mysqli_real_escape_string($con, $_POST['search_term']);
// Query to retrieve a list of students assigned to a program course


// Close the database connection
$con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TGMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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


<style>
  section{
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    padding-left: 20px;
    padding-right: 20px;

  }

</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index2.php" class="logo d-flex align-items-center">
        <img src="../pictures/logo.png" alt="">
        <span class="d-none d-lg-block"><b>TGMS</b></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../pictures/NashonProfile.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">ZB. Nashon Israel</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Nashon Israel</h6>
              <span>System Owner</span><br>
              <span>REG: 200230225910</span>
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
        <a class="nav-link collapsed" href="regester_student.php">
          <i class="bi bi-file-person-fill"></i>
          <span>Student Management</span>
        </a>
      </li><!-- End Gigs Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-book-fill"></i>
          <span>Upload Results</span>
        </a>
      </li><!-- End Gigs Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-collection-fill"></i>
          <span>Progrram Courses</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-briefcase-fill"></i>
          <span>Depertments</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-book-half"></i>
          <span>Semester Results</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-calendar2-x-fill"></i>
          <span>Summary Results</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Welcome at <b>TGMS</b></h1>
    </div><!-- End Page Title -->
<br>
<br>
    <section class="section dashboard">

      <!-- FONT GAGE TRANSCRIPT -->
      <section class=" d-flex  flex-column border border-3 border-dark m-3 pb-5 ">


      <div class="container px-5">
      <h2 clas="d-flex flex-column" style="align-items: cente;">
       <u><b>SELECT CLASS TO UPLOAD RESULTS</b></u>
      </h2>
      <p class="d-flex flex-column" style="align-items: center;"><i>font page student data</i></p>



<form action="upload_results.php" method="POST">

      <div class="row mb-3" >

        <div class="col-sm-4 themed-grid-col p-2">
          <input type="text" name="search_term">
          <input type="submit" name="search" value="search">
        </div>

        <div class="col-sm-4 themed-grid-col p-2">
          <div class="form-floating">

            <!-- php codes to check the number of rows -->

            <select class="form-select" name="c_id" id="floatingSelec" aria-label="Floating label select example">
              <option selected>Select Module</option>
           <?php
            // for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
            // $row = mysqli_fetch_assoc($result1);
            $sql1 = "SELECT module.modCode,module.modName FROM module";

            // Execute the query and get the result
            $result1 = mysqli_query($con, $sql1);

            // Check the query result
            if (mysqli_num_rows($result1) > 0) {
                // Initialize variables to store the total grade points and credits
                while ($row = mysqli_fetch_assoc($result1)) {
              // code...
            // echo "<option value='" .$course_id . "'>" . $course_name. "</option>";
            ?><option id="selected" value="<?php echo $row['modCode']?>"><?php echo $row['modName']; ?></option><?php }}?>
            </select>

            <label for="floatingSelect">Module</label>
      </div>
        </div>


        <!-- <div class="col-sm-2 themed-grid-col p-2">
          <button type="submit" name="submit" class="w100 btn btn-sm btn-outline-primary">view students</button>
        </div> -->


        </div>


</div>

<div class="container">
<?php
$search_term='';
$sql2 = "SELECT class.c_id,class.c_name, student.regNo,student.surname,student.givenNames,student.c_id
FROM class
JOIN student ON class.c_id = student.c_id
 WHERE class.c_name LIKE '%$search_term%' ";

$result2 =mysqli_query($con,$sql2);


  echo "<table>";
  echo  "<tr>";
  echo    "<th> Regestration Number  </th>";
  echo     "<th> Surname</th>";
  echo     "<th> Fullname  </th>";
  echo     "<th>  CA    </th>";
  echo     "<th>  FE    </th>";
  // echo     "<th> Upload </th>";
  echo   "</tr>";

       if (mysqli_num_rows($result2) > 0) {
         $regNo='';
         $Name='';
         $Surname='';


      // Loop through the query results to build rows of the table
      while($row2 =mysqli_fetch_assoc($result2)) {
        // Start a new row for each student

        $regNo= $row2["regNo"];
        $Fullname = $row2["givenNames"];
        $Surname = $row2["surname"];



      echo "<tr>";
      echo "<td>" . $regNo . "</td>";
      echo "<td>" . $Surname . "</td>";
      echo "<td>" . $Fullname . "</td>";

      // Add form fields for the continuous assessment and final exam scores
      echo "<td><input type='text' name='cascore_" . $regNo. "'></td>";
      echo "<td><input type='text' name='fescore_" . $regNo. "'></td>";

      // Add a submit button for each student
      // echo "<td><input type='submit' name='submit_" . $regNo. "' value='Submit'></td>";

      echo "</tr>";
    }

    }

echo  "</table>";
?>

  </form>
</div>

    </section>

  </main><!-- End #main -->





  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>~created By: Nashon Israel</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
