<?php
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   //check if user with this email already exist in the database
   $squ =" SELECT email FROM `students`  where email = '". $email. "'";
$result =  $conn->query($squ);


if ($result->num_rows > 0) {

    echo 'Email address already exists';
    die();
}else {
    $sql = "INSERT INTO `students` ( `full_names`,`country` ,`email`,`gender` ,`password`) VALUES ( '$fullnames', '$country' ,'$email','$gender' ,'$password')";

    if ($conn->query($sql) === TRUE) {

       echo  "User Successfully registered";
        } 
}
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    // echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    $sql = "SELECT email, password, full_names FROM `students` where email = '".$email."' AND password = '$password'";
$result =  $conn->query($sql);

print_r($result);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // print_r($row) ;
        $_SESSION['username'] =  $row['full_names'];
        header("Location: /user/dashboard.php"); 
    }
  

    
}else{
    header("Location: /"); 
}
    //if true then set user session for the user and redirect to the dasbboard
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
   $result = $conn->query("UPDATE `students` SET  `password` = '$password' where `email` = '$email'") ;
   
   if ($conn->affected_rows > 0) {
    echo "Details updated successfully";
  } else {
    echo "User does not exist " . $conn->error;
  }
   // echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     $sql = "DELETE FROM students WHERE id= '$id'";
     $conn->query($sql);

     if ($conn->affected_rows > 0) {
        echo "Deletion successfully";
      } else {
        echo "User does not exist " . $conn->error;
      }
     //delete user with the given id from the database
 }
