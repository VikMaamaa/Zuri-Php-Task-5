<?php
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

function db() {
    //set your configs here
    $host = "localhost";
    $user = "root2";
    $db = "zuriphp";
    $password = "";
    $conn = mysqli_connect($host, $user, $password, $db);
    if(!$conn){
        echo "<script> alert('Error connecting to the database') </script>";
    }
    return $conn;

}