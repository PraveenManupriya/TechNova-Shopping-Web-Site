<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname="technova";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    echo "Connection falied.";
}
?>