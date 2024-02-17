<?php

session_start();
error_reporting(0);
include('db_connection.php');
if(isset($_POST['login'])){
    $email=$_POST['username'];
    //$Password=md5($_POST['password']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$email' AND password = '$password'";
    $query=mysqli_query($con, $sql);


     $userData = mysqli_fetch_array($query);

   if(mysqli_num_rows($query) == 1){

      echo "<script>alert('Success')</script>";

        header("location:admin_dash/index2.php");

   }
   else {
     echo "<script>alert('Invalid Details');</script>";
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
  <form action="index.php" method="POST">

    <img class="mb-4" src="pictures/logo.png" alt="" width="88" height="100">
<!--    <h1 class="h3 mb-3 fw-normal"><b>TRANSCRIPT MANAGEMENT</b></h1> -->


    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="Email" required="True" name="username">
      <label for="floatingInput">Email address</label>
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
    <button class="w-100 btn btn-lg btn-primary" type="submit" name ="login">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Nathaniel & Daniel & Nasrah</p>
  </form>
</main>



  </body>
</html>
