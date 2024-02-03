<?php
include('../db_connection.php');
session_start();




//intialize variables
$regNo = '';
$givenNames = '';
$surname = '';
$gender ='';
$birthDate ='';
$admDate = '';
$grdDate ='';
$course_name='';
$roundedGPA ='';
$gpa ='';
$class ='';
$Picture='';
$semesters='';
$results ='';
$row='';
$result2['modCode']='';
$result2['modName']='';
$result2['grade']='';


// Check if the search button is pressed
if (isset($_POST['search'])) {
    // Get the search term
    $search_term = mysqli_real_escape_string($con, $_POST['search_term']);
    //$search_term = $_POST['search_term'];

    // Write the SQL query to retrieve data
    $sql = "SELECT student.regNo, student.givenNames,student.surname, student.gender,student.Picture, student.birthDate,student.grdDate,student.admDate,course.course_name,
    results.modCode,results.modName,results.grade,results.grade_point,results.credit
FROM student
JOIN course ON student.course_id = course.course_id
JOIN results ON student.regNo = results.regNo
WHERE student.regNo LIKE '%$search_term%' OR student.surname LIKE '%$search_term%'OR student.givenNames LIKE '%$search_term%' OR student.gender LIKE '%$search_term%'
    OR student.birthDate LIKE '%$search_term%' OR student.admDate LIKE '%$search_term%' OR course.course_name LIKE '%$search_term%' ";


    // Execute the query and get the result
    $result = mysqli_query($con, $sql);

    // Check the query result
    if (mysqli_num_rows($result) > 0) {
        // Initialize variables to store the total grade points and credits
        $total_grade_points = 0;
        $total_credits = 0;
        $regNo = '';
        $givenNames = '';
        $surname = '';
        $gender ='';
        $birthDate ='';
        $admDate = '';
        $grdDate = '';
        $course_name='';
        $Picture='';


        // Loop through the results to calculate the GPA
        while ($user = mysqli_fetch_assoc($result)) {
            $total_grade_points += $user["grade_point"] * $user["credit"];
            $total_credits += $user["credit"];
            $regNo = $user['regNo'];
            $givenNames = $user['givenNames'];
            $surname = $user['surname'];
            $gender = $user['gender'];
            $birthDate = $user['birthDate'];
            $admDate = $user['admDate'];
            $grdDate = $user['grdDate'];
            $course_name = $user['course_name'];
            $Picture = $user['Picture'];

        }

        // Calculate the GPA
        $gpa = $total_grade_points / $total_credits;

        $roundedGPA = round($gpa,1);


        // Set a value to compare the GPA against
        $upper_class_gpa = 3.5;

        // Determine if the GPA is considered upper class or lower class
        if ($gpa >= $upper_class_gpa) {
            $class = "Upper Class";
        } else {
            $class = "Lower Class";
        }

    } else {
        echo "No data found in the database.";
    }

    // SQL query to retrieve the results of the student
    $sql2 = "SELECT semester.sem_id,results.regNo, results.modCode, results.modName, results.grade,results.grade_point,results.credit
            FROM results
            INNER JOIN semester ON results.sem_id = semester.sem_id
            WHERE results.regNo LIKE '%$search_term%'";

      $result2 = mysqli_query($con, $sql2);
    // $result = $con->query($sql);

    // if ($result->num_rows > 0)
      if (mysqli_num_rows($result2) > 0) {
      // Create an empty array to store the results for each semester
      $semesters = array_fill(1, 6, array());


      // Loop through the results and group them by semester
      while($row = $result2->fetch_assoc()) {
        $semesters[$row['sem_id']][] = $row;

      }

      }
    }
      else {
     echo "No results found for registration number";
     }





// Close the connection
mysqli_close($con);


// Set a value to compare the GPA against
// $upper_class_gpa = 3.5;
//
// // Determine if the GPA is considered upper class or lower class
// if ($gpa >= $upper_class_gpa) {
//     $class = "Upper Class";
// } else {
//     $class = "Lower Class";
// }



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


<!--
  <script>
      function printPDF() {
        var div = new document.getElementById("transcript").innerH;
        var pdf = new jsPDF();
        pdf.addHTML(div, function() {
          pdf.save("Accademic-Transr.pdf");
        });
      }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->


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

      <li class="nav-item">
        <a class="nav-link collapsed" href="regester_student.php">
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



<!-- FONT GAGE TRANSCRIPT -->
<section class=" d-flex  flex-column border border-3 border-dark m-3 pb-5 ">

<div class="container px-5">
<h2 clas="d-flex flex-column" style="align-items: cente;">
 <u><b>ENTER REGISTRATION NUMBER FOR TRANSCRIPT</b></u>
</h2>
<p class="d-flex flex-column" style="align-items: center;"><i>font page student data</i></p>

<form action=" " method="post">




<div class="row mb-3" >
  <div class="col-sm-4 themed-grid-col p-2">
    <input type="text" name="search_term">
    <input type="submit" name="search" value="Search">
  </div>

    <!-- <div class="col-sm-4 themed-grid-col p-2">
      <input type="text" name="search_term2">
      <input type="submit" name="course" value="Search2">
    </div> -->

  <div class="col-sm-2 themed-grid-col p-2">
    <a class="w-100 btn btn-sm btn-primary"  href="#transcript"  >View Transcript</a>
  </div>
  </div>
</div>
<!-- FIRST ROW -->
<div class ="row m-2">


 <!-- Registration Number -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text"name="regNo" class="form-control" id="floatingInput" placeholder="" id="regNo" value="<?php echo $regNo?>">
     <label for="floatingInput"> Registration Number</label>
   </div>
 </div>

 <!--for full name  -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text"name="Fullname" class="form-control" id="floatingInput" placeholder="n"id="givenNames" value="<?php echo $givenNames ?>">
     <label for="floatingInput">Fullname</label>
   </div>
 </div>
<!-- Surname -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text" name="surname" class="form-control" id="floatingInput" placeholder=""id="surnames" value="<?php echo $surname ?>">
     <label for="floatingInput">Surname</label>
   </div>
 </div>

</div>

<!-- SECOND ROW -->
<div class ="row m-2">
<!-- gender -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text"name="gender" class="form-control" id="floatingInput" placeholder=""id="gender" value="<?php echo $gender?>">
     <label for="floatingInput"> Gender</label>
   </div>
 </div>

 <!--birth - date  -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="date" name="birthDate" class="form-control" id="floatingInput" placeholder="yyyy-mm-dd"id="birthDate" value="<?php echo $birthDate?>">
     <label for="floatingInput">Birth Date</label>
   </div>
 </div>
<!-- date of admision -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="datetime" name="admDate" class="form-control" id="floatingInput" placeholder="yyyy-mm-dd"id="admDate" value="<?php echo $admDate?>">
     <label for="floatingInput">Date Of Admision</label>
   </div
 </div>

</div>


<!-- THIRD ROW -->
<div class ="row m-2">
<!-- Award Title -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text" name="awardTitle" class="form-control" id="floatingInput" placeholder="" id="course_name" value="<?php echo $course_name ?>">
     <label for="floatingInput"> Award Title</label>
   </div>
 </div>

 <!--Classification of award  -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text"name="GPA_class" class="form-control" id="floatingInput" placeholder="5.333" id="class" value="<?php echo $class ?>">
     <label for="floatingInput">GPA Class</label>
   </div>
 </div>
<!-- Date of Graduation -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="date" name="grdDate" class="form-control" id="floatingInput" placeholder="2000-05-05" id="grdDate" value="<?php echo $grdDate?>">
     <label for="floatingInput">Graduation Date</label>
   </div>
 </div>

</div>

<!-- FOUTH ROW -->
<div class ="row m-2 ">

 <!-- overall GPA -->
 <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text" name="overall_GPA" class="form-control" id="floatingInput" placeholder="text"id="gpa" value="<?php echo $roundedGPA ?>">
     <label for="floatingInput">Overall GPA </label>
   </div>
 </div>
<!-- Student Picture -->
 <!-- <div class="col-sm-4 themed-grid-col p-2">
   <div class="form-floating">
     <input type="text"name="picture" class="form-control" id="floatingInput" placeholder="">
     <label for="floatingInput">Picture</label>
   </div>
 </div> -->

 <div class="col-sm-2 themed-grid-col p-2">
   <button class="w-100 btn btn-md btn-danger" type="submit" name="Submit">Remove Data</button>
 </div>
</div>
<!-- end of container div -->
</div>

</form>
<!-- end of font end transcript div -->
</section>
<div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

</div>




<div>
    <div id="transcript" >
<section class="border border-3 border-dark m-3  p-4 pb-5 mb-5" >
        <div class="row">
          <div class="col-md-3"><img src="../pictures/logo.png" alt="" width="150" height="150"></div>
          <div class="col-md-6">
           <p class="fs-3 text-center"> <b>DAR ES SALAAM INSTITUTE OF TECHNOLOGY</b> </p>
           <p class="fs-3 text-center"> <b>ACADEMIC TRANSCRIPT</b></p>
          </div>
          <div class="col-md-3" id="Picture" ><img src="" class="rounded float-end" alt="" width="150" height="150"></div>
        </div>
          <div class="row mb-5" id="zero_row"></div>
          <div class="position-relative ms-5 me-0 ps-5 pe-0">
            <div class="row mb-5" >
               <div class="col-md-3"id="surname"> <b>SURNAME</b> <p><?php echo $surname?></p> </div>
               <div class="col-md-3" id="Fullname"> <b>GIVEN NAMES</b> <p><?php echo $givenNames?></p></div>
               <div class="col-md-2" id="bithDate"> <b>BIRTHDATES</b> <p><?php echo $birthDate?> </p></div>
               <div class="col-md-1"id="gender"> <b>GENDER</b> <p><?php echo $gender?></p></div>
               <div class="col-md-3"id="regNo"> <b>REGISTRATION NUMBER</b> <p><?php echo $regNo?></p></div>
            </div>
            <div class="row mb-5" id="second_row">
               <div class="col-md-3"> <b>DATE OF ADMISSION:</b></div>
               <div class="col-md-3"> <?php echo $admDate?></div>
               <div class="col-md-3"> <b>DATE OF GRADUATION:</b></div>
               <div class="col-md-3"> <?php echo $grdDate?> </div>
            </div>
            <div class="row mb-5" id="third_row">
               <div class="col-md-3"> <b>AWARD TITLE:</b></div>
               <div class="col-md-9"><?php echo $course_name?></div>
            </div>
            <div class="row mb-5" id="fourth_row">
               <div class="col-md-3"> <b>CLASSIFICATION OF AWARDS:</b></div>
               <div class="col-md-9"id="class"><?php echo $class?></div>
            </div>
            <div class="row mb-5" id="fifth_row">
               <div class="col-md-3"> <b>OVERALL GPA:</b></div>
               <div class="col-md-9" id="gpa">
                 <?php echo $roundedGPA ?>
                </div>
            </div>
            <p id="bottom"> <b> <i>NOTE: The award and Classification is based on NTA Level 6 only.</i> </b></p>
            <div class="row mb-5" id="fifth_row"></div>
            <div class="row mb-2" id="fifth_row"></div>

            <!-- <p class="position-absolute bottom-0 end-0"> CC2020453678 </p> -->
            <button onclick="printPDF()" class="position-absolute bottom-0 end-0 btn btn-success">Print to PDF</button>
          </div>

      </section>
    </div>


    <div class ="row d-flex border border-dark m-1" id="results">
    <!-- Echo the results table for each semester -->
  <?php  for ($i = 1; $i <= 6; $i++) { ?>

    <!-- <section class=" d-flex  flex-column border border-3 border-dark m-3 pb-5 " style="height:99%;"> -->
<div class="col-6 sm1">
    <?php  echo "<h2>SEMESTER $i</h2>";?>
    <?php  echo "<table>
              <tr>
                <th>Mod_Code</th>
                <th>Mod_Name</th>
                <th>Grade</th>
              </tr>";?>

    <?php  foreach ($semesters[$i] as $result2) {?>

      <?php  echo "<tr>
                <td>".$result2['modCode']."</td>
                <td>".$result2['modName']."</td>
                <td>".$result2['grade']."</td>
              </tr>";?>
    <?php  }?>

      <?php echo "</table>"; ?>
<?php}?>
    </div>
<!-- </section> -->

  <?php  }?>
  <?php echo '<button onclick="printPDF()">Print PDF</button>';?>

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
