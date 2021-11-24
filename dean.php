<!DOCTYPE html>
<?php
include("connection.php");
if ($_GET['signout'] == 1) {
  session_start();
  session_unset();
  setcookie("username", "", time() - 3600);
  echo "<script>window.location.href='homefinal.php';</script>";
}

if($_GET['check']=='true'){
  session_start();
  $sid = $_SESSION['user'];
  include("connection.php");
   date_default_timezone_set("Asia/Kolkata");
  $date1 = strtotime(date("Y-m-d H:i:s"));
  $datem = date("m",$date1);
  $dated = date("d", $date1); 
  if(($datem==7 && $dated==1) || ($datem==1 && $dated ==1)){
    $sql1 = "select * from student where sid='$sid'";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row['degree']==1){
      $check=10;
    }else if($row['degree']==2){
      $check=6;
    }else if($row['degree']==3){
      $check=4;
    }else{
      $check=4;
    }
    if($row['semester']+1>$check){
      $show = "You are in your project semester!";
    }else{
      $sem = $row['semester'];
      $sql1 = "update student set semester='$sem' where sid='$sid'";
      $result = mysqli_query($conn, $sql1);
      $sql1 = "update student set registered='0' where sid='$sid'";
      $result = mysqli_query($conn, $sql1);
    }
  }
  $sql1 = "select * from student where sid='$sid'";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  if($row['registered']==0){
    echo '<div class="panel panel-primary" >
    <div class="panel-heading">Note</div>
    <div class="panel-body">You are not registered for'.' semester '.$row['semester'].' yet. ';
    echo '<a href="regsem.php">Click here</a> to register to access the course content!';
    ////.Do register for the semester to access the course content!';
    echo '</div>
  </div>
    ';
  }else{
    echo '<h2 style="text-align:center;font-weight:bold;">Core courses<h2>';
    echo '<table class="table table-bordered table-striped" style="font-size:18px;" id="couu">';
      echo '<thead>
    <tr>';
      echo '<th>Course ID</th>
      <th>Course name</th>
      <th>Credits</th>
      <th>Syllabus</th>
    </tr>
  </thead>';
      echo '<tbody >';
      $sql1 = "select * from student where sid='$sid'";
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $de = $row['degree'];
      $se = $row['semester'];
      $sql1 = "select * from course where courseid IN (select cid from learning where degree='$de' and semester1='$se') and type='C'";
      $result = mysqli_query($conn, $sql1);
      while ($row = mysqli_fetch_assoc($result)) {
       
          echo "<tr><td>{$row['courseid']}</td><td>{$row['coursename']}</td><td>{$row['credits']}</td><td><button class='btn btn-primary' onclick='show1(this.id);'><span class='glyphicon glyphicon-download-alt'></span>&nbsp;&nbsp;Download</button></td></tr>\n";
        
      }
      echo "</tbody>";
      echo "</table><br>";
      echo '<h2 style="text-align:center;font-weight:bold;">Elective courses<h2>';
      $sql1 = "select syllabus from course where courseid = (select elec from student where sid='$sid')";
      $result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$file = 'file:///home/sucharitha/Documents/data/'.$row['syllabus']; 
setcookie("file", $file, time() + (86400 * 30), "/"); // 86400 = 1 day
echo '<table class="table table-bordered table-striped" style="font-size:18px;">';
      echo '<thead>
    <tr>';
      echo '<th>Course ID</th>
      <th>Course name</th>
      <th>Credits</th>
      <th>Syllabus</th>
    </tr>
  </thead>';
      echo '<tbody >';
      session_start();
      $sid = $_SESSION['user'];
      $sql1 = "select * from course where courseid = (select elec from student where sid ='$sid')";
      $result = mysqli_query($conn, $sql1);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          echo "<tr><td>{$row['courseid']}</td><td>{$row['coursename']}</td><td>{$row['credits']}</td><td><button class='btn btn-primary' onclick='show5()'><span class='glyphicon glyphicon-download-alt'></span>&nbsp;&nbsp;Download</button></td></tr>\n";
        
 
      echo "</tbody>";
      echo "</table><br>";
  }
}
if (isset($_POST['showcourses'])) {
  $cou = $_POST['cou'];
  $prof = $_POST['prof'];
  $assoc = $_POST['assoc'];
  $assis = $_POST['assis'];
  if ($cou != '') {
    $sql1 = "update limits set numcourses='$cou'";
    $result = mysqli_query($conn, $sql1);
  }
  if ($prof != '') {
    $sql1 = "update limits set numstuprof='$prof'";
    $result = mysqli_query($conn, $sql1);
  }
  if ($assoc != '') {
    $sql1 = "update limits set numstuassoc='$assoc'";
    $result = mysqli_query($conn, $sql1);
  }
  if ($assis != '') {
    $sql1 = "update limits set numstuassis='$assis'";
    $result = mysqli_query($conn, $sql1);
  }
  echo "<script>alert('Controls updated successfully!');</script>";
}
?>
<html>

<head>
  <title> Dean page </title>
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
    .sidenav {
      height: 100%;
      width: 235px;
      position: fixed;
      z-index: 1;
      top: 50px;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      padding-top: 20px;
    }

    /* Style the sidenav links and the dropdown button */
    .sidenav a,
    .dropdown-btn {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 20px;
      color: #818181;
      display: block;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      outline: none;
    }

    .container {
      padding-top: 50px;
      padding-left: 0px;
      background-color: #f5f5f5;
    }

    .custom-header-panel {
      background-color: #004b8e;
      border-color: #004b8e;
      color: white;
    }

    .no-margin-form-group {
      margin: 0;
    }



    /* On mouse-over */
    .sidenav a:hover,
    .dropdown-btn:hover {
      color: #f1f1f1;
    }

    /* Main content */
    .main {
      margin-left: 150px;
      /* Same as the width of the sidenav */
      font-size: 20px;
      /* Increased text to enable scrolling */
      padding: 0px 10px;
    }

    /* Add an active class to the active dropdown button */
    .active {
      background-color: green;
      color: white;
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
      display: none;
      background-color: #262626;
      padding-left: 8px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
      float: right;
      padding-right: 8px;
    }

    /* Some media queries for responsiveness */
    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }
  </style>
</head>

<body onload='sh()'>
  <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" style="color:white;font-size:24px;font-weight:900;">Welcome back, <?php session_start();
                                                                                                  echo $_SESSION['user']; ?></a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active" style="left:45%;font-size:18px;right:10%;"><a href="dean.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;My dashboard</a></li>
        <li style="left:70%;font-size:18px;"><a href="homefinal.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Visit home page</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li style="font-size:16px;"><a href='admin.php?signout=1'><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
      </ul>
    </div>
  </nav>
  <div class="sidenav" style="position:fixed;">
    <br<br><br><br><br><br><br>
    
    <br>
    <a href="notleave.php"><span class="glyphicon glyphicon-bell"></span>&nbsp;Notifications</a><br>
    <a href="allotcourse.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Allot course</a><br>
    <a href="leaverec.php"><span class="glyphicon glyphicon-signal"></span>&nbsp;Leave Records</a>
    <br>
    
  </div>


  <div class="main" id="managecourses">
    <br>


    <div class="container" style="left:34%;margin-top:70px;">
      <div class="row">
        <div class="col-md-12">

          <form id="candidatedata" class="form-horizontal" method="POST" role="form" action="dean.php">
            <div class="col-md-offset-2 col-md-8">
              <div class="panel">
                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Dean controls</strong></h3>
                </div><br>
                <div class="panel-body">

                  <div class="form-group">
                    <label for="country" class="col-sm-6 control-label" style="font-weight:bold;font-size:16px;">Max number of courses to teach per semester</label>
                    <div class="col-sm-5">
                      <select id="cou" name="cou" class="form-control" onchange="dropoptions(this.value,'semester')">
                        <option value="" disabled="" selected="">Select the number</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-6 control-label" style="font-weight:bold;font-size:16px;">Max number of students a professor can supervise</label>
                    <div class="col-sm-5">
                      <select id="prof" name="prof" class="form-control" onchange="dropoptions(this.value,'semester')">
                        <option value="" disabled="" selected="">Select the number</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                  </div><br>

                  <div class="form-group">
                    <label for="country" class="col-sm-6 control-label" style="font-weight:bold;font-size:16px;">Max number of students an associate professor can supervise</label>
                    <div class="col-sm-5">
                      <select id="assoc" name="assoc" class="form-control" onchange="dropoptions(this.value,'semester')">
                        <option value="" disabled="" selected="">Select the number</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>

                      </select>
                    </div>
                  </div><br>

                  <div class="form-group">
                    <label for="country" class="col-sm-6 control-label" style="font-weight:bold;font-size:16px;">Max number of students an assistant professor can supervise</label>
                    <div class="col-sm-5">
                      <select id="assis" name="assis" class="form-control" onchange="dropoptions(this.value,'semester')">
                        <option value="" disabled="" selected="">Select the number</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>

                      </select>
                    </div>
                  </div><br>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" id="showcourses" name="showcourses">Save changes</button>
                  </div>

                </div>

              </div>
            </div>
        </div>
        </form>

      </div>

    </div>

  </div>



  

  

  <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    
    function sh(){
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }


  }

    

/* if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById("Firstshow").innerHTML = this.responseText;
            var table = document.getElementById('couu');
            if (typeof(table) != 'undefined' && table != null){
	      var temp=1;
	    for(var i=1;i<table.rows.length;i++){
		    var cells = table.rows[i];
		    cells.getElementsByTagName('button')[0].id=temp.toString();
		    temp=temp+1;
	    }
	    temp=1;}
					}
				};
				xmlhttp.open("GET","faculty.php?check=true",true);
		xmlhttp.send();
 */

    function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
   /* function newcourse(filename) {

      var mywindow = window.open(filename, '_blank', 'location=yes,resizable=no,left=260,height=600,width=920,scrollbars=yes,status=yes,titlebar=yes,top=70');
    }

    function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    var cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
         Removing whitespace at the beginning of the cookie name
        and compare it with the given string 
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
}
fu
    function printmap(){
      var got = getCookie('stat');
      if(got==0){
        document.getElementById('printmap').innerHTML+="Course with this ID does not exist";
        document.getElementById('printmap').style.display = 'block';
      }
    }

    function show(mancou, a,where){
      if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById(where).innerHTML = this.responseText;

					}
				};
				xmlhttp.open("GET","function.php?what="+mancou+"&who="+a,true);
		xmlhttp.send();
    }
*/
function show5(){
  var check = getCookie('file');
  window.location.href="viewcourses.php?url="+check;
}

function show1(take){
  if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            window.location.href="viewcourses.php?url="+this.responseText;

					}
				};
				xmlhttp.open("GET","ff.php?what="+take+"&who="+'s',true);
		xmlhttp.send();
}
  </script>

</body>

</html>