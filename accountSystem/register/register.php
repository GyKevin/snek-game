<?php

session_start();

//connect to database
$DB_DATABASE = "snekdatabase";
$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";

$dbc = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) or die("Couldn't connect to database");

if (mysqli_connect_errno()) {
    printf("Connection failed: ", mysqli_connect_errno());
    exit();
}

//global variables
$username = $_POST['username'];
$email = $_POST['email'];
$repass = $_POST['repass'];
$password = $_POST['password'];

//if field is empty
if(empty($username)) $_SESSION['errors']="Username required"; header("location: registerPage.php");
if(empty($email)) $_SESSION['errors']="Email required"; header("location: registerPage.php");
if(empty($password)) $_SESSION['errors']="Password required"; header("location: registerPage.php");
if($password !== $repass) $_SESSION['errors']="Passwords don't match"; header("location: registerPage.php");

//insert into db 
if(count($_SESSION['errors']) == 0) {
    
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";

    mysqli_query($dbc, $query);

}

?>