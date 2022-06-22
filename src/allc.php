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
 include("connection.php");
 session_start();
           $degree = $_GET['degree'];
          $semester = $_GET['semester'];
          $take = $_GET['take'];
          $i=0;
        //  echo $take;
          $sql1 = "select * from course where courseid IN (select cid from learning where degree='$degree' and semester1='$semester');";
            $result = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result)) {
                $i++;
                if($i==$take){
                    $cidd = $row['courseid'];
                    break;
                }
                
            }
            $tids = array();
            $sql1 = "select * from faculty";
            $result = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($tids,$row['fid']);
            }
            $points = array();
            for($j=0; $j<count($tids);$j++){
                array_push($points,0);
            }
            
            for($j=0; $j<count($tids);$j++){
                if(substr($tids[$j],0,4)=='PROF'){
                    $points[$j] += 10;
                }
                if(substr($tids[$j],0,4)=='ASSI'){
                    $points[$j] += 3;
                }
                if(substr($tids[$j],0,4)=='ASSO'){
                    $points[$j] += 5;
                }
                
            }

            $sql1 = "select * from preference where cid = '$cidd'";
            $result = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result)) {
                $ind = array_search($row['fid'],$tids );
                $points[$ind] += intval($row['pref'])*10;
            }

        //    echo $cidd;
        //    print_r($tids);
    //   echo array_search('PROF21SI',$fids);
           $sql1 = "select * from experience where cid = '$cidd'";
            $result = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result)) {
                $ind = array_search($row['fid'],$tids );
                // echo $ind;
                 $points[$ind] += intval($row['years'])*50;
            } 

            for($j=0; $j<count($tids);$j++){
                $f = $tids[$j];
                $sql1 = "select * from leaves where fid = '$f' and rep ='ACCEPTED'";
                $result = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_assoc($result)) {
                    $points[$j] -= intval($row['todate'])*5;
                }
            }

            $sql1 = "select * from faculty";
            $result = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_assoc($result)) {
                $ind = array_search($row['fid'], $tids);
                $points[$ind] -= intval($row['subs'])*20;
            }
            echo '<table class="table table-bordered w-auto" id="couuTable" >';
            echo '<thead >
            <tr>';
            echo  '<th style="text-align: center;">Faculty ID</th>
              <th style="text-align: center;">Faculty name</th>
              <th style="text-align: center;">Allot</th>
             
            </tr>
          </thead>';
            $final = array_combine($tids,$points);
            arsort($final);
            $final = array_keys($final);
            $_SESSION['teachers'] = $final;
            $_SESSION['couid']  = $cidd; 
            for($j=0;$j<count($final);$j++){
                $ch = $final[$j];
                $sql1 = "select * from faculty where fid='$ch'";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result);
                echo "<tr><td style='text-align:center;'>{$row['fid']}</td><td style='text-align:center;'>{$row['fname']}</td><td style='text-align:center;'><button class='btn btn-primary' onclick='show3(this.id);'>Allot</button></td></tr>\n";
            }




       /*  echo '<table class="table table-bordered w-auto" id="couTable" >';
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
        echo "</table>"; */
    ?>
    </body>