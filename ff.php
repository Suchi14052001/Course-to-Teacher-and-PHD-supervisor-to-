<?php
session_start();
include('connection.php');
if($_GET['who']=='s'){
  $i =0;
  $sid = $_SESSION['user'];
  $sql1 = "select * from student where sid='$sid'";
  $result = mysqli_query($conn,$sql1);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $de = $row['degree'];
        $se = $row['semester'];
        $sql1 = "select * from course where courseid IN (select cid from learning where degree='$de' and semester1='$se') and type='C'";
        $result = mysqli_query($conn,$sql1);
        while($row=mysqli_fetch_assoc($result)){
            $i = $i+1;
            if($i == intval($_GET['what'])){
              $temp = $row['syllabus'];
            }
          }
          $i=0;
          //$file = '/home/sucharitha/Documents/data/'.$temp; 
          $file = 'file:///home/sucharitha/Documents/data/'.$temp; 
          echo $file;
          
}
?>