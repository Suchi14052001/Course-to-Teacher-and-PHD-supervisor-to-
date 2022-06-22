<!DOCTYPE html>
<html>

<head>
  <style>
   /*  th,
    table,
    td {
      text-align: center;
    } */
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$i=0;
session_start();
$fid = $_SESSION['user'];
$k=0;
include("connection.php");
$deg = $_GET['deg'];
$sem = $_GET['sem'];
$num = json_decode($_GET['num']);

foreach($num as $d){
    $i++;
    if($d!=0){
        
        $sql1 = "select * from course where courseid IN (select cid from learning where degree='$deg' and semester1='$sem')";
        $result = mysqli_query($conn, $sql1);
        while($row=mysqli_fetch_assoc($result)){
            $k+=1;
            if($k == $i){
                $cid = $row['courseid'];
                $sql4 = "select * from preference where fid='$fid' and cid ='$cid'";
                $result2 = mysqli_query($conn, $sql4);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                $count2 = mysqli_num_rows($result2);
                if($count2==1){
                    $sql1 = "update preference set pref='$d' where fid='$fid' and cid='$cid'";
                    $result = mysqli_query($conn, $sql1);
                }else{
                $sql1 = "insert into preference values('$fid','$cid', '$d')";
                $result = mysqli_query($conn, $sql1);
                }
                break;
            }
        }
        $k=0;
    }
 }

 echo "<div class='alert alert-success alert-dismissible' style='margin-bottom:-50px;' >
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Preference for courses saved successfully!</strong>
        </div>";
?>
</body>
</html>