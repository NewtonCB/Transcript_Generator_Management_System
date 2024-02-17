<?php

session_start();
error_reporting(0);
include('db_connection.php');
if(isset($_POST['login'])){

  // Redirect to the dashboard
  header("location: admin_dash/index2.php");
  exit(); // Exit to prevent further execution

    $email=$_POST['username'];
    //$Password=md5($_POST['password']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM student WHERE $regNo = $email";
    $query=mysqli_query($con, $sql);

    

    if($query){

      // Check if there is a row with the given email
      if(mysqli_num_rows($query) == 1){

          // Fetch user data
          $userData = mysqli_fetch_array($query);


              

          
      } else {
          echo "<script>alert('User not found');</script>";
      }
  } else {
      echo "<script>alert('Query failed');</script>";
  }


}


 ?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <meta name="generator" content="Hugo 0.84.0">
    <title>TGMS</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }



      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

<main class="form-signin">
  

    <img class="mb-4" src="pictures/logo.png" alt="" width="88" height="100">
<!--    <h1 class="h3 mb-3 fw-normal"><b>TRANSCRIPT MANAGEMENT</b></h1> -->


    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Email" required="True" name="username" oninput="sessionStorage.setItem('regNo', this.value)">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required="True" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>

    <script>

      function go() {
        reg = document.getElementById('floatingInput').value;
        pass = document.getElementById('floatingPassword').value;

        if(reg == "nathaniel@gmail.com" && pass == "admin"){
          link = 'admin_dash/index2.php?module_code=COU 07501';
          //alert(link);
          location.replace(link);
        }
        else{
          alert("wrong credentials");
        }

        
      }

    </script>

    <button class="w-100 btn btn-lg btn-primary" name ="login" onclick="go()">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Nathaniel & Daniel & Nasrah</p>
  
</main>



  </body>
</html>
