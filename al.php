<!DOCTYPE html>
<html>
<?php
session_start();
include("connection.php");
$fromdate = $_GET['Difference'];
$from = $_GET['from'];
$reason = $_GET['reason'];
$fid = $_SESSION['user'];
// echo $reason;
$sql1 = "insert into leaves values('$from','$fromdate','$reason','$fid','WAITING')";
$result = mysqli_query($conn, $sql1);
$sql1 = "insert into leavescopy values('$from','$fromdate','$reason','$fid','WAITING')";
$result = mysqli_query($conn, $sql1);
echo "<div class='alert alert-success alert-dismissible' style='margin-bottom:-50px;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Leave request sent to Dean successfully. You can <a href='leaverec.php'>Click here</a> to check your leave status</strong>
                            </div></body>";
      echo "</html>";
?>
<head>
  <style>
    th,
    table,
    td {
      text-align: center;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
</body>
</html>