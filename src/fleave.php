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
 session_start();

    $which = $_GET['what'];
    include("connection.php");
    echo '<h2 style="text-align:center;font-weight:bold;margin-top:-20px;">Leave Notifications</h2><br>';
    if(intval($which)%2==0){
        $i=0;
        $which = intval($which)/2;
        // echo $which;
        $sql1 = "select * from leavescopy where rep='WAITING'";
        $result = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if($i==$which){
                $fromdate = $row['fromdate'];
                $numdays = $row['todate'];
                $reason = $row['reason'];
                $fid = $row['fid'];
                $sql1 = "delete from leavescopy where fromdate='$fromdate' and todate='$numdays' and reason='$reason' and fid='$fid'";
                $result = mysqli_query($conn, $sql1);
                break;
            }
        }
        $sql1 = "update leaves set rep='DENIED' where fromdate='$fromdate' and todate='$numdays' and reason='$reason' and fid='$fid'";
        $result = mysqli_query($conn, $sql1);

        echo '<table class="table table-bordered table-striped" id="couTable">';
    echo '<thead>
  <tr>';
    echo '<th>Faculty ID</th><th>From Date</th>
    <th>Number of days</th>
    <th>Reason</th>
    <th>Accept</th>
    <th>Deny</th>
  </tr>
  </thead>';
    echo '<tbody id="myTable">';
    $sql1 = "select * from leavescopy where rep='WAITING'";
    $result = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr><td>{$row['fid']}</td><td>{$row['fromdate']}</td><td>{$row['todate']}</td><td>{$row['reason']}</td><td><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;Agree</button></td><td><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-down'></span>&nbsp;&nbsp;Deny</button></td></tr>\n";
    }
    echo "</tbody>";
    echo "</table>"; 
    }else{
        $i=0;
        $which = floor(intval($which)/2)+1;
        // echo $which;
        $sql1 = "select * from leavescopy where rep='WAITING'";
        $result = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if($i==$which){
                $fromdate = $row['fromdate'];
                $numdays = $row['todate'];
                $reason = $row['reason'];
                $fid = $row['fid'];
                $sql1 = "delete from leavescopy where fromdate='$fromdate' and todate='$numdays' and reason='$reason' and fid='$fid'";
                $result = mysqli_query($conn, $sql1);
                break;
            }
        }
        $sql1 = "update leaves set rep='ACCEPTED' where fromdate='$fromdate' and todate='$numdays' and reason='$reason' and fid='$fid'";
        $result = mysqli_query($conn, $sql1);

        echo '<table class="table table-bordered table-striped" id="couTable">';
    echo '<thead>
  <tr>';
    echo '<th>Faculty ID</th><th>From Date</th>
    <th>Number of days</th>
    <th>Reason</th>
    <th>Accept</th>
    <th>Deny</th>
  </tr>
  </thead>';
    echo '<tbody id="myTable">';
    $sql1 = "select * from leavescopy where rep='WAITING'";
    $result = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr><td>{$row['fid']}</td><td>{$row['fromdate']}</td><td>{$row['todate']}</td><td>{$row['reason']}</td><td><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;Agree</button></td><td><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-down'></span>&nbsp;&nbsp;Deny</button></td></tr>\n";
    }
    echo "</tbody>";
    echo "</table>"; 
    }



  ?>
</body>

</html>