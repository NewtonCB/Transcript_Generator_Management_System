<?php

include ('db_connection.php');


 ?>

 <DOCTYPE! html>
 <htmm lang="en">

<head>

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    margin-left: 40px;
    background-color: #f5f5f5;
  }

  section{
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    padding-left: 20px;
    padding-right: 20px;

  }

  .display{
    display: flex;
    align-items: center;
    padding-left: 100px;
    background-color: #f5f5f5;
  }

</style>

<title>student_data</title>
</head>

<body>
<!-- FONT GAGE TRANSCRIPT -->
<section class=" d-flex  flex-column border border-3 border-dark m-3 pb-5 ">

<div class="container">
<h2 clas="d-flex flex-column" style="align-items: cente;">
  <u><b>PLEASE FILL THE REQUIRED FIELD BELOW</b></u>
</h2>
<p class="d-flex flex-column" style="align-items: center;"><i>font page student data</i></p>
<!-- FIRST ROW -->
<div class ="row mb-3">
  <!-- Registration Number -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput"> Registration Number</label>
    </div>
  </form>
  </div>

  <!--for full name  -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Fullname</label>
    </div>
  </form>
  </div>
<!-- Surname -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Surname</label>
    </div>
  </form>
  </div>

</div>

<!-- SECOND ROW -->
<div class ="row mb-3">
<!-- gender -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput"> Gender</label>
    </div>
  </form>
  </div>

  <!--birth - date  -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Birth Date</label>
    </div>
  </form>
  </div>
<!-- date of admision -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Date Of Admision</label>
    </div>
  </form>
  </div>

</div>


<!-- THIRD ROW -->
<div class ="row mb-3">
<!-- Award Title -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput"> Award Title</label>
    </div>
  </form>
  </div>

  <!--Classification of award  -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">GPA Class</label>
    </div>
  </form>
  </div>
<!-- Date of Graduation -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Graduation Date</label>
    </div>
  </form>
  </div>

</div>

<!-- FOUTH ROW -->
<div class ="row mb-3">

  <!-- overall GPA -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="text">
      <label for="floatingInput">Overall GPA </label>
    </div>
  </form>
  </div>
<!-- Student Picture -->
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Picture</label>
    </div>
  </form>
  </div>

</div>
<!-- end of container div -->
</div>
<!-- end of font end transcript div -->
</section>


<!-- SEMESTER RESULT SUMMARY PAGE -->
<section class=" d-flex  flex-column border border-3 border-dark m-3 pb-5 ">
<div class="container">

<h2 clas="d-flex flex-column" style="align-items: cente;">
  <b><u>FETCH SEMESTER RESULTS OF A STUDENT</u></b>
</h2>
<!-- fetch semester student data -->
<div class ="display row mb-3 ">
  <div class="col-sm-4 themed-grid-col">
  <form action =" " method = "get">
    <div class="form-floating mb-2">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Registration Number</label>
    </div>
    <button class="w-100 btn btn-md btn-secondary" type="submit" name ="login" style="align-items: left;">Submit</button>
  </form>
  </div>

</div>

</div>
</section>



</body>

 </html>
