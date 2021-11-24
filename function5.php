<?php


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

session_start();
include("connection.php");
$block=0;
$sid = $_GET['sid'];
$sname = $_GET['sname'];
$email = $_GET['email'];
$phone = $_GET['phone'];
if($sname!=""){
$sql1 = "UPDATE student
  SET sname = '$sname'
  WHERE sid='$sid'";
  $result = mysqli_query($conn, $sql1);
}
$block1=$block2=0;
if($email!=""){
    if (!filter_var(test_input($email), FILTER_VALIDATE_EMAIL)) {
        $block1=1;
    }
    if($block!=1){
    $sql1 = "UPDATE student
    SET email = '$email'
    WHERE sid='$sid'";
$result = mysqli_query($conn, $sql1);}
}

if($phone!=""){
    $pattern = "/\^[1-9]\d{9}\$/";
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    if(strlen($phone)!=10 || $phone[0]=='0'){
        $block2=1;
    }
    if($block2!=1){
    $sql1 = "UPDATE student
    SET phone = '$phone'
    WHERE sid='$sid'";
    $result = mysqli_query($conn, $sql1);
}}

if($block1==1){
    echo "<body><br><div class='alert alert-danger alert-dismissible' style='font-size:16px;margin-top:-25px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Email ID is not in required format!</strong>
        </div></body>";
        echo "</html>";

}else if($block2==1){
    echo "<body><br><div class='alert alert-danger alert-dismissible' style='font-size:16px;margin-top:-25px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Phone number is not in required format!</strong>
        </div></body>";
        echo "</html>";
}else{
echo "<body><br><div class='alert alert-success alert-dismissible' style='font-size:16px;margin-top:-25px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Student data successfully updated!</strong>
        </div></body>";
        echo "</html>";

}  


?>