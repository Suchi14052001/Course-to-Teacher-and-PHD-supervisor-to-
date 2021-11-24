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

          $degree = $_GET['degree'];
          $semester = $_GET['semester'];
          $id = $_GET['which'];
          include("connection.php");
      
      
      
        $id = intval($_GET['which'])/2;
        // echo "<script>alert('Came inside');</script>";
        $sql1 = "select * from student where degree='$degree' and semester ='$semester'";
        $result = mysqli_query($conn, $sql1);
        $temp=1;
        while ($row = mysqli_fetch_assoc($result)) {
          if($temp==$id){
            $todelete = $row['sid'];
            break;
          }
          $temp = $temp+1;
        }
        $sql1 = "DELETE FROM student where sid = '$todelete'";
        $result = mysqli_query($conn, $sql1);
        $sql1 = "DELETE FROM login where username = '$todelete'";
        $result = mysqli_query($conn, $sql1);
        $sql1 = "DELETE FROM researchInterest where id = '$todelete'";
        $result = mysqli_query($conn, $sql1);

        echo '<table class="table table-bordered table-striped" id="couTable">';
        echo '<thead>
      <tr>';
        echo  '<th>Student ID</th>
        <th>Student name</th>
        <th>Phone</th>
        <th>Email ID</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>';
        echo '<tbody id="myTable">';
        $sql1 = "select * from student where degree='$degree' and semester ='$semester'";
        $result = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>{$row['sid']}</td><td>{$row['sname']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;Edit</button</td><td><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Delete</button</td></tr>\n";
          
        }
        echo "</tbody>";
        echo "</table>";
    ?>
    </body>