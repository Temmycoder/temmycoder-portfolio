<?php 

$servername = 'localhost';
$username = 'temmyco1_temmy';
$password = 'teesmart270809';
$dbname = 'temmyco1_temmycoder';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $msg = $_POST['msg'];

  $query = mysqli_query($conn, "INSERT INTO clients (first_name, last_name, email, phone, message) 
  values ('$fname', '$lname', '$phone', '$email', '$msg')");

  if($query){
    header("location: index.html");
  }else{
    echo "failed to insert";
  }
}