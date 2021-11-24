<!DOCTYPE html>
<?php
include("connection.php");
if ($_GET['signout'] == 1) {
  session_start();
  session_unset();
  setcookie("username", "", time() - 3600);
  echo "<script>window.location.href='homefinal.php';</script>";
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
  <title> Admin page </title>
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
      width: 200px;
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

<body style="position:relative;">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" style="color:white;font-size:24px;font-weight:900;">Welcome back, <?php session_start();
                                                                                                  echo $_SESSION['user']; ?></a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active" style="left:45%;font-size:16px;right:10%;"><a href="admin.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;My dashboard</a></li>
        <li style="left:70%;font-size:16px;"><a href="homefinal.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Visit home page</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li style='font-size:16px;'><a href='admin.php?signout=1'><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
      </ul>
    </div>
  </nav>
  <div class="sidenav navbar-fixed-top">
    <br><br><br><br><br><br><br>

    <a href="managecourses.php">Manage courses</a>

    <br>
    <button class="dropdown-btn">Manage users
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="managestudents.php">Students</a>
      <a href="manageteachers.php">Teachers</a>
    </div>
    <br>
    <!-- <a href="#contact">My account</a> -->
  </div>


  <div class="main" id="managecourses">
    <br>


    <div class="container" style="left:34%;margin-top:70px;">
      <div class="row">
        <div class="col-md-12">

          <form id="candidatedata" class="form-horizontal" method="POST" role="form" action="admin.php">
            <div class="col-md-offset-2 col-md-8">
              <div class="panel">
                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Admin controls</strong></h3>
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
  </script>

</body>

</html>