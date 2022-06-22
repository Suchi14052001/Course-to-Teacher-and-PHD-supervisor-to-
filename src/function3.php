<?php
session_start();
include("connection.php");
$block=0;
$cid = $_GET['cid'];
$cname = $_GET['cname'];
$credits = $_GET['credits'];
$type = $_GET['type'];
if($cname!=""){
$sql1 = "UPDATE course
  SET coursename = '$cname'
  WHERE courseid='$cid'";
  $result = mysqli_query($conn, $sql1);
}

if($credits!=""){
$sql1 = "UPDATE course
SET credits = '$credits'
WHERE courseid='$cid'";
$result = mysqli_query($conn, $sql1);
}

if($type!=""){
if($type==1){
$sql1 = "UPDATE course
SET type = 'C'
WHERE courseid='$cid'";
}else{
$sql1 = "UPDATE course
SET type = 'E'
WHERE courseid='$cid'";
}
$result = mysqli_query($conn, $sql1);
}

echo "<body><br><div class='alert alert-success alert-dismissible' style='font-size:16px;margin-top:-25px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Course data successfully updated!</strong>
        </div></body>";
        echo "</html>";

        


?>