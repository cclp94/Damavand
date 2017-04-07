<?php
define('URL', 'http://localhost:3000/');
$companyName = basename($_POST["companyName"]);
$username = basename($_POST["username"]);
$password = basename($_POST["password"]);
$email = basename($_POST["email"]);
// TODO add user to db
(new User($username, $password, 0))->put();
// If successful 
//TODO create user session and send to next page


// Else return error
//header('Location:' .URL, TRUE, 302);

function redirect($target){
    header("Location: ../".$target.".php"); /* Redirect browser */
    exit();
}
?>