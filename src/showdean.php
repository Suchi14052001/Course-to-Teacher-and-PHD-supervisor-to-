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

          $degree = $_GET['degree'];
          $semester = $_GET['semester'];
          include("connection.php");
      
        $sql1 = "select * from course where courseid IN (select cid from learning where degree='$degree' and semester1='$semester');";
        $result = mysqli_query($conn, $sql1);
       
        
        echo '<table class="table table-bordered w-auto" id="couTable" >';
        echo '<thead >
        <tr>';
        echo  '<th style="text-align: center;">Course ID</th>
          <th style="text-align: center;">Course name</th>
          <th style="text-align: center;">Credits</th>
          <th style="text-align: center;">Type</th>
          <th style="text-align: center;">Recommend</th>
         
        </tr>
      </thead>';
        echo '<tbody id="myTable">';
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['type'] == 'C') {
            echo "<tr><td style='text-align:center;'>{$row['courseid']}</td><td style='text-align:center;'>{$row['coursename']}</td><td style='text-align:center;'>{$row['credits']}</td><td style='text-align:center;'>Core</td><td style='text-align:center;'><button class='btn btn-primary' onclick='show1(this.id);'>Recommend</button></td></tr>\n";
          } else {
            echo "<tr><td style='text-align:center;'>{$row['courseid']}</td><td style='text-align:center;'>{$row['coursename']}</td><td style='text-align:center;'>{$row['credits']}</td><td style='text-align:center;'>Elective</td><td style='text-align:center;'><button class='btn btn-primary' onclick='show1(this.id);'>Recommend</button></td></tr>\n";
          }
        }
        echo "</tbody>";
        echo "</table>";
    ?>
    </body>