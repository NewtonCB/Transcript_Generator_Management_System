<?php
include('../db_connection.php');
session_start();

if(isset($_POST['submit'])) { // Check if form is submitted
    // Get form data
    $regNo = $_POST['regNo'];
    $NHIF_Number = $_POST['NHIF_Number'];
    $CSSE_index = $_POST['CSSE_index'];
    $Phone_No = $_POST['Phone_No'];
    $surname = $_POST['surname'];
    $givenNames = $_POST['givenNames'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['birthDate'];
    $admDate = $_POST['admDate'];
    $grdDate = $_POST['grdDate'];
    $dept_id = $_POST['dept_id'];
    $course_id = $_POST['course_id'];
    $level_id = $_POST['level_id'];
    $Nationality = $_POST['Nationality'];


    // Insert data into database
    $sql = "INSERT INTO student (regNo,NHIF_Number,CSSE_index,Phone_No,Nationality,surname,givenNames,gender,birthDate,admDate,grdDate,dept_id,course_id,level_id)
    VALUES ('$regNo','$NHIF_Number','$CSSE_index','$Phone_No','$Nationality','$surname','$givenNames','$gender','$birthDate','$admDate','$grdDate','$dept_id','$course_id','$level_id')";
    //$sql1 = "INSERT INTO student (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($con,$sql) === TRUE) {

       echo "New record created successfull";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
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
        <a class="nav-link collapsed" href="">
          <i class="bi bi-file-person-fill"></i>
          <span>Student Management</span>
        </a>
      </li><!-- End Gigs Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="upload_results.php">
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
<!-- SOME CONTENTS HAVE REMOVED HERE SEE content.html page  -->

<div >
  <!--initialize  a part for register student  -->
<section class="d-flex border border-3  m-3  pb-5">

  <div class="container px-5">
  <h2 clas="d-flex flex-column" style="align-items: cente;">
   <u><b> FILL THE FIELDS BELLOW TO REGESTER STUDENT</b></u>
  </h2>
  <p class="d-flex flex-column" style="align-items: center;"><i>student details</i></p>

  <div class="container">

   <form action="regester_student.php"  method="POST">
    <!-- FIRST ROW -->
    <div class ="row mb-3">
     <!-- Registration Number -->
     <div class="col-sm-4 themed-grid-col ">
       <div class="form-floating">
         <input type="text"name="regNo" class="form-control" id="floatingInput" placeholder="">
         <label for="floatingInput"> Registration Number (start: 20023022..0001)</label>
       </div>
     </div>

     <!--for full name  -->
     <div class="col-sm-4 themed-grid-col ">
       <div class="form-floating">
         <input type="text"name="givenNames" class="form-control" id="floatingName" placeholder="Fullname">
         <label for="floatingName">Fullname</label>
       </div>
     </div>
    <!-- Surname -->
     <div class="col-sm-4 themed-grid-col ">
       <div class="form-floating">
         <input type="text" name="surname" class="form-control" id="floatingInput" placeholder="">
         <label for="floatingInput">Surname</label>
       </div>
     </div>

    </div>

    <!-- SECOND ROW -->
    <div class ="row mb-3">
    <!-- gender -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <select class="form-select" name="gender" id="floatingSelect" aria-label="Floating label select example">
           <option selected>Select Gender</option>
           <option value="MALE">MALE</option>
           <option value="FEMALE">FEMALE</option>
         </select>
         <label for="floatingSelect">Gender</label>
       </div>
     </div>

     <!--birth - date  -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="date" name="birthDate" class="form-control" id="floatingInput" placeholder="2000-05-05">
         <label for="floatingInput">Birth Date</label>
       </div>
     </div>
    <!-- date of admision -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="date" name="admDate" class="form-control" id="floatingInput" placeholder="2000-05-05">
         <label for="floatingInput">Date Of Admision</label>
       </div>


    </div>


    <!-- THIRD ROW -->
    <div class ="row mb-3 mt-3">
    <!-- Award Title -->
     <div class="col-sm-4 themed-grid-col ">

       <div class="form-floating">

         <!-- php codes to check the number of rows -->

         <select class="form-select" name="course_id" id="floatingSelect" aria-label="Floating label select example">
           <option selected>Select a Program Below</option>
        <?php
         // for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
         // $row = mysqli_fetch_assoc($result1);
         $sql1 = "SELECT course.course_id,course.course_name FROM course ORDER BY course_id";

         // Execute the query and get the result
         $result1 = mysqli_query($con, $sql1);

         // Check the query result
         if (mysqli_num_rows($result1) > 0) {
             // Initialize variables to store the total grade points and credits
             while ($row = mysqli_fetch_assoc($result1)) {
           // code...
         // echo "<option value='" .$course_id . "'>" . $course_name. "</option>";
         ?><option value="<?php echo $row['course_id']?>"><?php echo $row['course_name']; ?></option><?php }}?>
         </select>

         <label for="floatingSelect">Program Courses</label>
   </div>
    </div>

     <!--Classification of award  -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <select class="form-select" name="Nationality" id="floatingSelect" aria-label="Floating label select example">
           <option selected>Choose Country</option>
           <option value="1">Tanzania United Republic</option>
           <option value="2">Kenya</option>
           <option value="3">Uganda</option>
           <option value="3">Rwanda</option>
           <option value="3">Burundi</option>
           <option value="3">South Africa</option>
           <option value="3">Congo DRC</option>
           <option value="3">South Sudan</option>
           <option value="3">Somaria</option>
         </select>
         <label for="floatingSelect">Nationality</label>
</div>
     </div>
    <!-- Date of Graduation -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="date" name="grdDate" class="form-control" id="floatingInput" placeholder="2000-05-05" >
         <label for="floatingInput">Graduation Date</label>
       </div>
     </div>

    </div>

    <!-- FOUTH ROW -->
    <div class ="row mb-3 ">

     <!-- index -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="text" name="CSSE_index" class="form-control" id="floatingInput" placeholder="text" >
         <label for="floatingInput">CSSE_index-( eg: s1706.0113.2018 )</label>
       </div>
     </div>
      <!-- nhif number -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="text" name="NHIF_Number" class="form-control" id="floatingInput" placeholder="text" >
         <label for="floatingInput">NHIF_Number</label>
       </div>
     </div>
         <!-- picture -->
     <div class="col-sm-4 themed-grid-col">
       <div class="form-floating">
         <input type="tel" name="Phone_No" class="form-control" id="floatingInput" placeholder="Phone">
         <label for="floatingInput">Phone</label>
       </div>
     </div>




  </div>

  <!-- FIFTH ROW -->
<div class="row mb-3">

  <div class="col-sm-4 themed-grid-col">
    <div class="form-floating">
      <select class="form-select" name="dept_id" id="floatingSelect" aria-label="Floating label select example">
        <option selected>Select Department</option>
        <?php
         // for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
         // $row = mysqli_fetch_assoc($result1);
         $sql2 = "SELECT department.dept_id,department.dept_name FROM department ORDER BY dept_id";

         // Execute the query and get the result
         $result2 = mysqli_query($con, $sql2);

         // Check the query result
         if (mysqli_num_rows($result2) > 0) {
             // Initialize variables to store the total grade points and credits
             while ($row2 = mysqli_fetch_assoc($result2)) {
           // code...
         // echo "<option value='" .$course_id . "'>" . $course_name. "</option>";
         ?><option value="<?php echo $row2['dept_id']?>"><?php echo $row2['dept_name']; ?></option><?php }}?>

        </select>
      <label for="floatingSelect">Department</label>
  </div>
  </div>

<div class="col-sm-4 themed-grid-col">
  <div class="form-floating">
    <select class="form-select" name="level_id" id="floatingSelect" aria-label="Floating label select example">
      <option selected>Select NTA_Level</option>
      <?php
       // for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
       // $row = mysqli_fetch_assoc($result1);
       $sql3 = "SELECT nta_level.level_id,nta_level.level_status FROM nta_level ORDER BY level_id";

       // Execute the query and get the result
       $result3 = mysqli_query($con, $sql3);

       // Check the query result
       if (mysqli_num_rows($result3) > 0) {
           // Initialize variables to store the total grade points and credits
           while ($row3 = mysqli_fetch_assoc($result3)) {
         // code...
       // echo "<option value='" .$course_id . "'>" . $course_name. "</option>";
       ?><option value="<?php echo $row3['level_id']?>"><?php echo $row3['level_status']; ?></option><?php }}?>
       </select>

    </select>
    <label for="floatingSelect">NTA_Level</label>
  </div>
</div>

  <div class="col-sm-4 themed-grid-col mt-4  ">
    <button type="submit" name="submit" value="submit" class="w-80 btn btn-md btn-success">Regester Sudent</button>
  </div>

</form>
</div>

</section>
<!-- end of section -->

</div>
<!-- end of section -->




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
  <script>
      const handleValidation = () => {
        var field = document.getElementById("surname");
        if(field.value.lenght < 6){

        }
      }
  </script>
</body>

</html>
