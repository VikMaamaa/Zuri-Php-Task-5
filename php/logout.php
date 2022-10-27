<?php 

ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

session_start();

function logout(){
    /*
Check if the existing user has a session

if it does
destroy the session and redirect to login page
*/
if($_SESSION['username']){
    // remove all session variables
session_unset();

// destroy the session
session_destroy(); 
}

header("Location: /user/forms/login.html");
}

logout();


?>