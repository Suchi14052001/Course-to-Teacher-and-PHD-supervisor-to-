<!DOCTYPE html>
<html>

<head>
  <style>
      .slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 14px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 20px;
  height: 15px;
  border-radius: 50%;
  background: #04AA6D;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #04AA6D;
  cursor: pointer;
}
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
include("connection.php");
$deg = $_GET['deg'];
$sem = $_GET['sem'];
echo '<table class="table table-bordered table-striped" style="font-size:16px;" id="couTable">';
      echo '<thead>
    <tr>';
      echo '<th>Course ID</th>
      <th>Course name</th>
      <th>Credits</th>
      <th>Preference</th>
    </tr>
  </thead>';
      echo '<tbody >';
      $sql1 = "select * from course where courseid IN (select cid from learning where degree='$deg' and semester1 = '$sem')";
$result = mysqli_query($conn,$sql1);
    while ($row = mysqli_fetch_assoc($result)) {
       
          echo "<tr><td>{$row['courseid']}</td><td>{$row['coursename']}</td><td>{$row['credits']}</td><td><div class='slidecontainer'> <input type='range' min='0' value='0' max='10' class='slider' oninput='see(this.id)'><p>Value: <span>0</p></span></div></td></tr>\n";
        
      }
      echo "</tbody>";
      echo "</table>"; 
     echo ' <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary" id="showcourses" name="showcourses" onclick="savepref()">Save preferences</button>
                                </div>';
?>
</body>
</html>