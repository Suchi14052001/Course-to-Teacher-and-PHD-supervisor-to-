<!DOCTYPE html>
<?php
include("connection.php");
if(isset($_POST['map'])){
  
    $cid = $_POST['cid'];
    $degree = $_POST['degree'];
    $semester1 = $_POST['semester1'];
    $sql1 = "select * from course where courseid='$cid'";
                  $result = mysqli_query($conn, $sql1);
                  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $count = mysqli_num_rows($result);
    if($count==0){
                  $s5 = "Course with course ID ";
          $s7 = " does not exist!";
                  $s6 = $s5.$cid.$s7;

                  echo "<html>";
                  echo "<body><br><div class='alert alert-danger alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong>".''.$s6.' ';
                  echo "</strong>
                  </div></body>";
                  echo "</html>";
    }else{
      $sql1 = "select * from learning where cid='$cid' and degree='$degree' and semester1 = '$semester1'";
                  $result = mysqli_query($conn, $sql1);
                  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $count = mysqli_num_rows($result);
      if($count==0){
        $sql1 = "insert into learning(cid, degree, semester1) values ('$cid', '$degree', '$semester1');";
                  $result = mysqli_query($conn, $sql1);
                  if($degree==1){
                    $deg = 'IMTech';
                  }else if($degree==2){
                    $deg = 'MCA';
                  }else if($degree==3){
                    $deg = 'MTech';
                  }else{
                    $deg = 'PHD';
                  }
                  $s5 = "Course with ID ".$cid." is successsfully mapped to ".$deg." and ".$semester1." semester";
                  echo "<html>";
                  echo "<body><br><div class='alert alert-success alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong>".''.$s5.' ';
                  echo "</strong>
                  </div></body>";
                  echo "</html>";
      }else{
        if($degree==1){
          $deg = 'IMTech';
        }else if($degree==2){
          $deg = 'MCA';
        }else if($degree==3){
          $deg = 'MTech';
        }else{
          $deg = 'PHD';
        }
  $s5 = "Course with ID ".$cid." is already mapped to ".$deg." and ".$semester1." semester";
  echo "<html>";
  echo "<body><br><div class='alert alert-info alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".''.$s5.' ';
  echo "</strong>
  </div></body>";
  echo "</html>";
      }
    }
  }
?>
<html>
    <head>
        <title>Map a course to degree</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      .container {
      padding-top: 50px;
      background-color: #f5f5f5;
    }
    .custom-header-panel {
      background-color: #004b8e;
      border-color: #004b8e;
      color: white;
    }
  </style>
    </head>
    <body>

   
<div class="main" id="mapcourses" >

    <br>
    <div class="col-sm-12 controls" style="left:580px;margin-top:20px;margin-bottom:20px;">
      <button type="button" style="width:180px;" class="btn btn-primary" onclick="newcourse('viewcourses.php');"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<strong>View courses list</strong></button>
    </div><br>
    <div id="printmap" class='alert alert-danger alert-dismissible' style='display:none;margin-left:60px;margin-top:60px;margin-right:180px;margin-bottom:-28px;font-size:16px;'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong></strong>
    </div>
    <div class="container" style="margin-top:60px;" >
      <div class="row">
        <div class="col-md-12">

          <form id="mapform" class="form-horizontal" method="POST" role="form" action="mapcourse.php">
            <div class="col-md-offset-2 col-md-8">
              <div class="panel">
                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Map courses</strong></h3>
                </div><br>
                <div class="panel-body">


                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="name" style="font-weight:bold;font-size:16px;">Course ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="cid" id="cid" required="" maxlength="70" placeholder="Enter course ID">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Degree</label>
                    <div class="col-sm-8">
                      <select required="" id="degree" name="degree" class="form-control" onchange="dropoptions(this.value,'semester1')">
                        <option value="" disabled="" selected="">Select the degree</option>
                        <option value="1">IMTech</option>
                        <option value="2">MCA</option>
                        <option value="3">MTech</option>
                        <option value="4">PHD</option>

                      </select>
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Semester</label>
                    <div class="col-sm-8">
                      <select id="semester1" name="semester1" class="form-control" required="">
                        <option value="" disabled="" selected="">Select the semester</option>


                      </select>
                    </div>
                  </div><br>
                  <div class="form-group text-center">
                    
                    <button type="submit" class="btn btn-primary" id="map" name="map" >Map</button>
                  </div>

                </div>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </body>
  <script>
      function newcourse(filename) {

var mywindow = window.open(filename, '_blank', 'location=yes,resizable=no,left=260,height=600,width=920,scrollbars=yes,status=yes,titlebar=yes,top=70');
}

function dropoptions(take, id) {
      var x = document.getElementById(id);
      var count = 2;
      while (count <= x.length) {
        x.remove(x.length - 1);
      }
      if (take == 1) {
        count = 1;
        while (count <= 10) {
          var option = document.createElement("option");
          option.text = count.toString();
          x.add(option, x[count]);
          count++;
        }
      } else if (take == 2) {
        count = 1;
        while (count <= 6) {
          var option = document.createElement("option");
          option.text = count.toString();
          x.add(option, x[count]);
          count++;
        }
      } else {
        count = 1;
        while (count <= 4) {
          var option = document.createElement("option");
          option.text = count.toString();
          x.add(option, x[count]);
          count++;
        }
      }
    }
  </script>
</html>