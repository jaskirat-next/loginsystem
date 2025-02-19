<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD']=="POST"){
include 'components/dbconnect.php';
$username = $_POST["username"];
$password = $_POST["password"];
$conpassword = $_POST["conpassword"];
$set_alert = false;
$exist = false; 
if($password == $conpassword && $exist == false){
$sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";
$result = mysqli_query($conn, $sql);
if($result){
    $set_alert = true;
    header("Location: signup.php?success=1");
    exit();
}
else{
    echo "Failed";
}
}
}

$set_alert = isset($_GET['success']) ? true : false;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'components/_nav.php' ?>
    <?php
    if($set_alert){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created. Now you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
    echo '<script>
            setTimeout(function(){
            window.location.href = "signup.php";
            }, 3000)
          </script>';
    }

    ?>
    <div class="container my-4">
        <h3 style="text-align:center">Fill form for Sign up</h3>
        <form  action="/loginsystem/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="conpassword" class="form-label">Conform Password</label>
                <input type="password" class="form-control" id="conpassword" name="conpassword">
                <div id="emailHelp" class="form-text">Make sure you password will same..</div>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>