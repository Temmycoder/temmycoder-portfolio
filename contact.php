<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';

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

  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host       = 'mail.temmycoderdev.com.ng';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'temmyco1';             // SMTP username
    $mail->Password   = 'teesmart270809';                   // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable TLS encryption, ssl also accepted
    $mail->Port       = 465;                              // TCP port to connect to

    //Recipients-interface
    $mail->setFrom('temiloluwa@temmycoderdev.com.ng', 'TemmyCoder');
    $mail->addAddress($email,);     // Add a recipient

    // Content
    $mail->isHTML(true);    // Set email format to HTML
    $mail->Subject = 'Temmycoder';
    $mail->Body    = "Thank you for reaching out $fname, kindly chat this number for further conversations \n Tel: 07066246499";
    $mail->AltBody = "hello";

    $mail->send();
    echo'Email has been sent';
  } catch (Exception $e) {
    echo"Email could not be sent. Mailer Error: {$mail->ErrorInfo}";

  }
  
  if($query){
    header("location: index.html");
  }else{
    echo "<div class='alert alert-danger'>Failed to send</div>";
  }
}