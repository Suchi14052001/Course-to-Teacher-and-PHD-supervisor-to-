<?php
session_start();
include("connection.php");
$i =0;
$sql = "select syllabus from course";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $i = $i+1;
    if($i == intval($_GET['which'])){
		$temp = $row['syllabus'];
	}
}
$i=0;
//$file = '/home/sucharitha/Documents/data/'.$temp; 
$file = 'file:///home/sucharitha/Documents/data/'.$temp; 
echo $file;

?>