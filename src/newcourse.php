<!DOCTYPE html>

<?php
include("connection.php");
if (!empty($_POST)) {
  if (isset($_POST['addcourse'])) {
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $target_dir = '/home/sucharitha/Documents/data/';
    $credits = $_POST['credits'];
    $type = $_POST['type'];
    $sql1 = "select * from course where courseid='$cid'";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      //echo "Course with this ID is already there\n";
      echo "<body><br><div class='alert alert-danger alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Course with ";
      echo $cid . " already exists!</strong>
      </div></body>";
      echo "</html>";
    } else {
      //echo "Came into the else block";
      if (isset($_FILES['syll'])) {
        $syll = htmlspecialchars(basename($_FILES["syll"]["name"]));
        $target_file = $target_dir . $syll;
        //echo "/nThis is the targetfile".$target_file."\n";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "pdf"||$imageFileType != "docx") {
          $uploadOk = 3;
        }
        if ($uploadOk == 3) {
          //echo "In uploadOk is 3";
          echo "<body><br><div class='alert alert-danger alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Only pdf/docx type syllabus document is accepted!</strong>
        </div></body>";
          echo "</html>";
        } else {
          //echo "Almost about to move";

          if (move_uploaded_file($_FILES["syll"]["tmp_name"], $target_file)) {
            //echo "About to insert";

            if ($type == 1) {
              $sql3 = "INSERT INTO course (courseid,coursename,credits,syllabus,type) VALUES('$cid', '$cname', '$credits', '$syll','C')";
            } else if ($type == 2) {
              $sql3 = "INSERT INTO course (courseid,coursename,credits,syllabus,type) VALUES('$cid', '$cname', '$credits', '$syll','E')";
            }
            $result = mysqli_query($conn, $sql3);
            echo "<body><br><div class='alert alert-success alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Course with ID " . $cid;
            echo " is entered into the database successfully!</strong>
          </div></body>";
            echo "</html>";
          } else {
            //echo "File move avvaledu";
            //print_r($_FILES);
            echo "<body><br><div class='alert alert-danger alert-dismissible' style='margin-top:20px;margin-left:80px;margin-right:80px;margin-bottom:-10px;' >
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Sorry! Error uploading file!</strong>
          </div></body>";
            echo "</html>";
          }
        }
      }/*else{
        //echo '<br File error is >'.var_dump($_FILES).'<br>';
        echo "FIle is not set";
      }*/
    }
  }/*else{
    echo "Add course is not set";
  }*/
}/*else{
  echo "Im not having any post variables";
}*/

?>

<html>

<head>
  <title> Add a new course </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: "Lato", sans-serif;
    }

    /* Fixed sidenav, full height */


    /*.container {
      padding-top: 50px;
      background-color: #f5f5f5;
    }*/

    .custom-header-panel {
      background-color: #004b8e;
      border-color: #004b8e;
      color: white;
    }

    .no-margin-form-group {
      margin: 0;
    }

    .container {
      padding-top: 50px;
      background-color: #f5f5f5;
    }

    .custom-header-panel {
      background-color: #004b8e;
      border-color: #004b8e;
      color: white;
    }

    /* On mouse-over */

    /* Main content */
    .main {
      margin-left: 0px;
      /* Same as the width of the sidenav */
      font-size: 20px;
      /* Increased text to enable scrolling */
      padding: 0px 10px;
    }



    /* Some media queries for responsiveness */
    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }


    }
  </style>
</head>

<body>
  <div class="main" id="managecourses">
    <br>

    <div class="container" style="position:absolute;left:10%;">
      <div class="row">
        <div class="col-md-12">

          <form id="candidatedata" enctype="multipart/form-data" class="form-horizontal" method="POST" role="form" action="newcourse.php">
            <div class="col-md-offset-2 col-md-8">
              <div class="panel">

                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Add a new course</strong></h3>
                </div><br>


                <div class="panel-body">

                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="name" style="font-weight:bold;font-size:16px;">Course ID </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="cid" id="cid" value="" required maxlength="70" placeholder="Type course ID">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="name" style="font-weight:bold;font-size:16px;">Course name </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="cname" id="cname" value="" required maxlength="70" placeholder="Type course name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Credits</label>
                    <div class="col-sm-8">
                      <select id="credits" name="credits" class="form-control" required>
                        <option value="" disabled="" selected="">Select credits</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>

                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Type</label>
                    <div class="col-sm-8">
                      <select id="type" name="type" class="form-control" required>
                        <option value="" disabled="" selected="">Select type of course</option>
                        <option value="1">Core</option>
                        <option value="2">Elective</option>

                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="formFileSm" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Syllabus</label>
                    <div class="col-sm-8">
                      <input class="form-control form-control-sm" id="syll" name="syll" type="file" required />
                    </div>
                  </div><br>


                  <div style="margin-top:0px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls" style="left:15%;position:absolute;">
                      <input type="submit" style="width:30%;" id="addcourse" name="addcourse" class="btn btn-primary" value="Add course">
                    </div>
                    <div class="col-sm-12 controls" style="left:55%;position:absolute;">
                      <input type="reset" id="clear" style="width:30%;" name="clear" class="btn btn-danger" value="Clear">
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
  <script>
    /*$(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });*/
  </script>
</body>