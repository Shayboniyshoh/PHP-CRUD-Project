<?php 
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'pizza_php');

// checking database
if(!$conn){
    echo 'Database connection error: ' . mysqli_connect_error();
}

?>