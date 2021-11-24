<!DOCTYPE html>
<?php
function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

include("connection.php");
if(isset($_POST['addstudent'])){
  /* foreach ($_POST['ri'] as $selectedOption)
    echo $selectedOption."\n"; */
    date_default_timezone_set("Asia/Kolkata");
    $date1 = strtotime(date("Y-m-d H:i:s"));
    if(date("m",$date1)>=7 && date("m",$date1)<=12){
      $sname = $_POST['sname'];
      $degree = $_POST['degree'];
     // echo $degree;
      $email = $_POST['emailId'];
      $phone = $_POST['phone'];
      $words = explode(" ", $sname);
      $acronym = "";
      foreach ($words as $w) {
        $acronym .= $w[0];
      }
      if($degree==1){
        $acronym = "IMT".date("y",$date1).$acronym;
      }else if($degree==2){
        $acronym = "MCA".date("y",$date1).$acronym;
      }else if($degree==3){
        $acronym = "MT".date("y",$date1).$acronym;
      }else{
        $acronym = "PHD".date("y",$date1).$acronym;
      }
        $sql1 = "select * from student where degree='$degree' and sid='$acronym'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count>=1){
          if($degree==1){
            $deg = 'IMTech';
          }else if($degree==2){
            $deg = 'MCA';
          }else if($degree==3){
            $deg = 'MTech';
          }else{
            $deg = 'PHD';
          }
          $toPrint = "Student with ID ".$acronym." already exists in ".$deg." 1st semester";
          echo "<html>";
          echo "<body><div> <div class='alert alert-danger alert-dismissible' style='margin-top:10px;margin-left:50px;margin-right:50px;margin-bottom:-20px;'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>".$toPrint;
          echo "</strong>
          </div></div></body>";
          echo "</html>";
        }else{
          $sql1 = "INSERT INTO student (sid, sname, phone, email, degree, semester) VALUES ('$acronym', '$sname', '$phone', '$email', '$degree','1')";
          $result = mysqli_query($conn, $sql1);
          foreach ($_POST['ri'] as $selectedOption){
            $sql1 = "INSERT INTO researchInterest (id,field) VALUES ('$acronym', '$selectedOption')";
            $result = mysqli_query($conn, $sql1);
          }
          if($degree==1){
            $deg = 'IMTech';
          }else if($degree==2){
            $deg = 'MCA';
          }else if($degree==3){
            $deg = 'MTech';
          }else{
            $deg = 'PHD';
          }

          $toPrint = "Student with name ".$sname." is successfully added to ".$deg." 1st semester. Login details are"."<br>";
          $pass = randomPassword();
          $toPrint1 = "User ID is ".$acronym." Password is ".$pass;
          $sql1 = "INSERT INTO login (username,password,role,unsuccessfulLogins,block,blockdate,lastloggedin) VALUES ('$acronym', '$pass','S','0','0',NULL,NULL)";
          $result = mysqli_query($conn, $sql1);
          echo "<html>";
          echo "<body><div> <div class='alert alert-success alert-dismissible' style='margin-top:10px;margin-left:50px;margin-right:50px;margin-bottom:-20px;text-align:center;'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          ".$toPrint."<strong>".$toPrint1."</strong>";
          $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: sucharitha.isukapalli@gmail.com' . "\r\n";
$headers .= 'Reply-To: ' .'sucharitha.isukapalli@gmail.com' . "\r\n";
          
if(mail($email,'Your login details',$toPrint1,$headers)){
echo "  An email with login details is sent to the Student";
}else{
  echo "Error sending email to the student";
}


          echo "
          </div>
        
          </div>
          
          </body>";
          echo "</html>";  
        }
    }else{
      echo "<html>";
      echo "<body><div> <div class='alert alert-danger alert-dismissible' style='margin-top:10px;margin-left:50px;margin-right:50px;margin-bottom:-20px;'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Students cannot be added in the winter Semester!</strong>
      </div></div></body>";
      echo "</html>";
    }
}
?>


<html>

<head>
  <title> Add a new student </title>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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

          <form id="candidatedata" enctype="multipart/form-data" class="form-horizontal" method="POST" role="form" action="newstudent.php">
            <div class="col-md-offset-2 col-md-12">
              <div class="panel">

                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Add a new student</strong></h3>
                </div><br>


                <div class="panel-body">

                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="name" style="font-weight:bold;font-size:16px;">Student name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="sname" id="sname" value="" required maxlength="70" placeholder="Type student name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Degree</label>
                    <div class="col-sm-8">
                      <select id="degree" name="degree" required class="form-control" onchange="dropoptions(this.value,'semester')" style="height:35px;">
                        <option value="" disabled="" selected="">Select the degree</option>
                        <option value="1">IMTech</option>
                        <option value="2">MCA</option>
                        <option value="3">MTech</option>
                        <option value="4">PHD</option>

                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Research Interest</label>
                    <div class="col-sm-8">
                      <select id="ri" placeholder="Select research Interest" name="ri[]" class="selectpicker form-control border border-5 rounded" multiple data-live-search="true" style="height:35px;">
                        <option>Computer architecture</option>
                        <option>Compiler design</option>
                        <option>Software Engineering</option>
                        <option>Bio informatics</option>
                        <option >Databases</option>
                        <option >Computer Graphics</option>
                        <option >Networks</option>
                        <option >Information security</option>
                        <option >Robotics</option>
                        <option>Artificial Intelligence</option>
                      </select>
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Email ID</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" id="emailId" name="emailId" placeholder="Enter email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="formFileSm" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Phone number</label>
                    <div class="col-sm-8">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="6665432123" pattern="[1-9]{1}[0-9]{9}" required>
                    </div>
                  </div><br>


                  <div style="margin-top:0px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls" style="left:15%;position:absolute;">
                      <input type="submit" style="width:30%;" id="addstudent" name="addstudent" class="btn btn-primary" value="Add Student">
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
  $('select').selectpicker();
  
  </script>
</body>