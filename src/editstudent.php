<!DOCTYPE html>
<html>

<head>
  <title> Update student details </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
  <?php 
  session_start();
  include("connection.php");
  $degree = $_GET["degree"];
  $semester = $_GET["semester"];
  $id = floor($_GET["which"] / 2) + 1;
  $temp = 1;
  $sql1 = "select * from student where degree='$degree' and semester ='$semester'";
  $result = mysqli_query($conn, $sql1);
  while ($row = mysqli_fetch_assoc($result)) {
    if ($temp == $id) {
      break;
    }
    $temp++;
  }
  $_SESSION['sid'] = $row["sid"];
  $_SESSION['sname'] = $row["sname"];
  $_SESSION['phone'] = $row["phone"];
  $_SESSION['email'] = $row["email"];

  /*if (isset($_POST['editcourse'])) {
    $block=0;
    $cid = $_SESSION['courseid'];
    if ($_FILES['syll'] != "") {
      $syll = htmlspecialchars(basename($_FILES["syll"]["name"]));
      $target_dir = '/home/sucharitha/Documents/data/';
      $target_file = $target_dir . $syll;
      //echo "/nThis is the targetfile".$target_file."\n";
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      if ($imageFileType != "pdf") {
        $uploadOk = 3;
      }
      if ($uploadOk == 3) {
        //echo "In uploadOk is 3";
        echo "<body><br><div class='alert alert-danger alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Only pdf type syllabus document is accepted!</strong>
        </div></body>";
        echo "</html>";
        $block=1;
      } else {
        //echo "Almost about to move";

        if (move_uploaded_file($_FILES["syll"]["tmp_name"], $target_file)) {
          //echo "About to insert";
          $cid = $_SESSION['courseid'];
          $sql1 = "select * from course where courseid='$cid'";
          $result = mysqli_query($conn, $sql1);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $file_pointer = '/home/sucharitha/Documents/data/';
          $file_pointer = $file_pointer.$row['syllabus'];
		      if (!unlink($file_pointer)) {  
			    //echo ("$file_pointer cannot be deleted due to an error");  
		       }  
	    	else {  
			//echo ("$file_pointer has been deleted");  
	      	}
        $sql1 = "UPDATE course
        SET syllabus = '$syll'
        WHERE courseid='$cid'";
        $result = mysqli_query($conn, $sql1);
        
        }else{
          echo "<body><br><div class='alert alert-danger alert-dismissible' >
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error uploading new syllabus document!</strong>
        </div></body>";
        echo "</html>";
        $block=1;
        }
      }
    } 

    if($block!=1 && $_POST['cname']!=""){
        $cname = $_POST['cname'];
      $sql1 = "UPDATE course
        SET coursename = '$cname'
        WHERE courseid='$cid'";
        $result = mysqli_query($conn, $sql1);
    }

    if($block!=1 && $_POST['cname']!=""){
      $cname = $_POST['cname'];
    $sql1 = "UPDATE course
      SET coursename = '$cname'
      WHERE courseid='$cid'";
      $result = mysqli_query($conn, $sql1);
  }
  if($block!=1 && $_POST['credits']!=""){
    $credits = $_POST['credits'];
  $sql1 = "UPDATE course
    SET credits = '$credits'
    WHERE courseid='$cid'";
    $result = mysqli_query($conn, $sql1);
}
if($block!=1 && $_POST['type']!=""){
  $type = $_POST['type'];
  if($type==1){
    $sql1 = "UPDATE course
    SET type = 'C'
    WHERE courseid='$cid'";
  }else{
    $sql1 = "UPDATE course
    SET type = '$E'
    WHERE courseid='$cid'";
  }
  
  $result = mysqli_query($conn, $sql1);
}
if($block!=1){
  echo "<body><br><div class='alert alert-success alert-dismissible' '>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Course data successfully updated!</strong>
        </div></body>";
        echo "</html>";
}

  }*/
  ?>
  <div class="main" id="managecourses" style=" background-color: #f5f5f5;">
    <br>

    <div class="row">
      <div class="col-md-14">

        <form id="candidatedata" enctype="multipart/form-data" class="form-horizontal" method="POST" role="form" action="editcourse.php">
          <div class="col-md-offset-2 col-md-8">

<p id='heree'></p>
            <div class="panel">

              <div class="panel-heading custom-header-panel">
                <h3 class="panel-title" style="text-align:center;">Student edit form for Student ID <?php session_start();
                                                                                                  echo $_SESSION['sid']; ?> </h3>
              </div><br>


              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="name" style="font-size:14px;">Student ID </label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control" name="sid" id="sid" maxlength="70" placeholder="Type course ID" value="<?php
                                                                                                                                            session_start();
                                                                                                                                            echo $_SESSION['sid'];
                                                                                                                                            ?>" style="text-align:left;">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="name" style="font-size:14px;">Student name </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="sname" id="sname" value="<?php
                                                                                            session_start();
                                                                                            echo $_SESSION['sname'];
                                                                                            ?>" maxlength="70" placeholder="Type course name">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="name" style="font-size:14px;">Email ID </label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" id="email" value="<?php
                                                                                            session_start();
                                                                                            echo $_SESSION['email'];
                                                                                            ?>" maxlength="70" placeholder="Type course name">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="name" style="font-size:14px;">Phone number </label>
                  <div class="col-sm-8">
                    <input type="tel" pattern="[1-9]{1}[0-9]{9}" class="form-control" name="phone" id="phone" value="<?php
                                                                                            session_start();
                                                                                            echo $_SESSION['phone'];
                                                                                            ?>" maxlength="70" placeholder="Type course name">
                  </div>
                </div>

                

               <br>


                <div style="margin-top:0px" class="form-group">

                  <div class="col-sm-12 controls" style="left:85px;position:absolute;">
                    <input type="button" onclick="show4()" style="width:30%;" id="editcourse" name="editcourse" class="btn btn-primary" value="Save changes">
                  </div>
                  <div class="col-sm-12 controls" style="left:270px;position:absolute;">
                    <input type="reset" id="clear" style="width:30%;" name="clear" class="btn btn-success" value="Reset">
                  </div>
                </div>

              </div><br><br>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
</body>
<script>

</script>
</html>