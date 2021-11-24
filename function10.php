<?php

session_start();
include("connection.php");
$take =$_GET['take'];
$final = $_SESSION['teachers'];
$couid = $_SESSION['couid'];
// echo $_GET['take'];
$ind =$final[$take-1];
$sql1 = "select * from faculty where fid='$ind'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
// print_r($_SESSION['teachers'][$take]);

$sql2 = "select * from limits";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$chh =intval($row['subs'])+1;
if($chh>$row2['numcourses']){
    echo "<body><br><div class='alert alert-danger alert-dismissible' style='font-size:16px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>".$row['fid'].' is already teaching '.$row['subs'].' number of courses';
         echo "!</strong>
        </div></body>";
        echo "</html>";
}else{
    $tid = $row['fid'];
    $sql5 = "insert into teaching values('$tid','$couid')";
    $result5 = mysqli_query($conn, $sql5);
    $up = intval($row['subs'])+1;
    $sql5 = "update faculty set subs='$up' where fid='$tid'";
    $result5 = mysqli_query($conn, $sql5);
    $sql5 = "select * from experience where fid='$tid' and cid ='$couid'";
    $result5 = mysqli_query($conn, $sql5);
    $row = mysqli_fetch_array($result5, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result5);
    if($count>=1){
        $sql5 = "update experience set years='$chh' where fid='$tid' and cid='$couid'";
        $result5 = mysqli_query($conn, $sql5);
    }else{
        $sql5 = "insert into experience values('$tid','$couid')";
        $result5 = mysqli_query($conn, $sql5);
    }
    echo "<body><br><div class='alert alert-success alert-dismissible' style='font-size:16px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>".'Course alloted successfully!';
         echo "!</strong>
        </div></body>";
        echo "</html>";
}

?>