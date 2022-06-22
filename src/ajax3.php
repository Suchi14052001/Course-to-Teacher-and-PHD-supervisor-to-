<?php
include("connection.php");
$deg = $_GET['deg'];
echo '<table class="table table-bordered table-striped" id="couTable">';
        echo '<thead>
      <tr>';
        echo  '<th>Teacher ID</th>
        <th>Teacher name</th>
        <th>Phone</th>
        <th>Email ID</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>';
        echo '<tbody id="myTable">';
        $sql1 = "select * from faculty where cadre='$deg'";
        $result = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>{$row['fid']}</td><td>{$row['fname']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;Edit</button</td><td><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Delete</button</td></tr>\n";
          
        }
        echo "</tbody>";
        echo "</table>";
?>