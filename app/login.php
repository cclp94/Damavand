<?php
define('URL', 'http://localhost:3000/');
$username = basename($_POST["username"]);
$password = basename($_POST["password"]);
// TODO query db for user

// If successful 
//TODO create user session and send to next page


// Else return error
//header('Location:' .URL, TRUE, 302);

function redirect($target){
    header("Location: ../".$target.".php"); /* Redirect browser */
    exit();
}
?>