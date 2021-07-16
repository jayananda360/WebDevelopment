<?php
$servername = "localhost";
$username = "id17099901_test123";
$password = "Test@123456789";
$dbname = "id17099901_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Not Connected...";
}else{
    echo "Connected to Database...";
}
?>