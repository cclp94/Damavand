<?php
session_start();
require './models/user.php';
define('URL', 'http://localhost:3000/');
$username = basename($_POST["username"]);
$password = basename($_POST["password"]);
// TODO query db for user

// If successful 
//TODO create user session and send to next page
$user = User::getUserMock($username, $password);

$_SESSION['action'] = 'login';

if(isset($user) || $user != null){
    $_SESSION['user'] = serialize($user);
    redirect('home');
}else{
    $_SESSION['error'] = "Username or password incorrect";
    redirect('index');
}

function redirect($target){
    header("Location: ../".$target.".php"); /* Redirect browser */
    exit();
}
?>