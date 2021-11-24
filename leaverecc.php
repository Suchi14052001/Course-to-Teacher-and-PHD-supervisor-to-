<?php
include("connection.php");
if(isset($_GET['cadre'])){
  session_start();
  $fid = $_GET['cadre'];
 
  echo '<table class="table table-bordered table-striped" id="couTable" style="margin-left:270px;margin-top:20px;">';
  echo '<thead>
<tr>';
  echo '<th>Faculty ID</th><th>From Date</th>
  <th>Number of days</th>
  <th>Reason</th>
  <th>Status</th>
</tr>
</thead>';
  echo '<tbody id="myTable">';
  $sql1 = "select * from leaves where fid IN (select fid from faculty where cadre='$fid')";
  $result = mysqli_query($conn, $sql1);
  while ($row = mysqli_fetch_assoc($result)) {
    
      echo "<tr><td>{$row['fid']}</td><td>{$row['fromdate']}</td><td>{$row['todate']}</td><td>{$row['reason']}</td><td>{$row['rep']}</td></tr>\n";
  }
  echo "</tbody>";
  echo "</table>";
}
?>
<script>
   
</script>