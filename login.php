<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$login = false;
$showError = false; 
if($_SERVER['REQUEST_METHOD']=="POST"){
include 'components/dbconnect.php';
$username = $_POST["username"];
$password = $_POST["password"];


$sql = "SELECT * from   users where username = '$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num == 1){
  while($row=mysqli_fetch_assoc($result)){
    if(password_verify($password, $row['password'])){

      $login = true;
      session_start();
      $_SESSION['logedin'] = true;
      $_SESSION['username'] = $username;
      header("Location: welcome.php?success=1");
        exit();
    }
    else{
      $showError = "Invalid Credentials";
    }
  }
}
else{
  $showError = "Invalid Credentials";
}

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'components/_nav.php' ?>
    <?php
    if($login){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are loged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
    echo '<script>
            setTimeout(function(){
            window.location.href = "signup.php";
            }, 3000)
          </script>';
    }
    if($showError){
      echo'
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Invalid</strong>  username and password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo'<script>
        setTimeout(function(){
        window.location.href="login.php";
    },3000)
      </script>';
    }

    ?>
    <div class="container my-4">
        <h3 style="text-align:center">Fill form for Login</h3>
        <form  action="/loginsystem/login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>