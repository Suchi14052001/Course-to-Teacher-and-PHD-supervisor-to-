<!DOCTYPE html>
<html>

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
<?php 
if (isset($_GET['role']) && isset($_GET['degree']) && isset($_GET['semester'])) {
          $degree = $_GET['degree'];
          $semester = $_GET['semester'];
          $role = $_GET['role'];
          include("connection.php");
      
      
      
        $id = intval($_GET['which'])/2;
        echo "<script>alert('Came inside');</script>";
        $sql1 = "select * from course where courseid IN (select cid from learning where degree='$degree' and semester1='$semester');";
        $result = mysqli_query($conn, $sql1);
        $temp=1;
        while ($row = mysqli_fetch_assoc($result)) {
          if($temp==$id){
            $todelete = $row['courseid'];
            break;
          }
          $temp = $temp+1;
        }
        $sql1 = "DELETE FROM learning where degree='$degree' and semester1 = '$semester' and cid = '$todelete'";
        $result = mysqli_query($conn, $sql1);

      $sql1 = "select * from learning where degree='$degree' and semester1='$semester'";
      $result = mysqli_query($conn, $sql1);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if ($count == 0) {
  
        if ($degree == 1) {
          $deg = 'IMTech';
        } else if ($degree == 2) {
          $deg = 'MCA';
        } else if ($degree == 3) {
          $deg = 'MTech';
        } else {
          $deg = 'PHD';
        }
        $toprint = "Sorry! There are no courses mapped to " . $deg . " semester " . $semester . " currently!";
        echo "<html>";
        echo "<body><div class='alert alert-danger alert-dismissible' style='margin-left:60px;margin-right:260px;position:absolute;'>
                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>$toprint</strong>
                              </div></body>";
        echo "</html>";
      } else {
        $sql1 = "select * from course where courseid IN (select cid from learning where degree='$degree' and semester1='$semester');";
        $result = mysqli_query($conn, $sql1);
        echo '<table class="table table-bordered w-auto" id="couTable" style="text-align: center;margin-left:23px;position:absolute;">';
        echo '<thead >
        <tr>';
        echo  '<th style="text-align: center;">Course ID</th>
          <th style="text-align: center;">Course name</th>
          <th style="text-align: center;">Credits</th>
          <th style="text-align: center;">Edit</th>
          <th style="text-align: center;">Delete</th>
          <th style="text-align: center;">Type</th>
        </tr>
      </thead>';
        echo '<tbody id="myTable">';
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['type'] == 'C') {
            echo "<tr><td style='text-align:center;'>{$row['courseid']}</td><td style='text-align:center;'>{$row['coursename']}</td><td style='text-align:center;'>{$row['credits']}</td><td style='text-align:center;'><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;Edit</button></td><td style='text-align:center;'><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Delete</button></td><td style='text-align:center;'>Core</td></tr>\n";
          } else {
            echo "<tr><td style='text-align:center;'>{$row['courseid']}</td><td style='text-align:center;'>{$row['coursename']}</td><td style='text-align:center;'>{$row['credits']}</td><td style='text-align:center;'><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;Edit</button></td><td style='text-align:center;'><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Delete</button></td><td style='text-align:center;'>Elective</td></tr>\n";
          }
        }
        echo "</tbody>";
        echo "</table>";
      }
    }
    ?>
    </body>