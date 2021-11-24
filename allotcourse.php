<!DOCTYPE html>
<?php
include("connection.php");
if ($_GET['signout'] == 1) {
  session_start();
  session_unset();
  setcookie("username", "", time() - 3600);
  echo "<script>window.location.href='homefinal.php';</script>";
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

<body >
  <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" style="color:white;font-size:24px;font-weight:900;">Welcome back, <?php session_start();
                                                                                                  echo $_SESSION['user']; ?></a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active" style="left:45%;font-size:18px;right:10%;"><a href="faculty.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;My dashboard</a></li>
        <li style="left:70%;font-size:18px;"><a href="homefinal.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Visit home page</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li style="font-size:16px;"><a href='admin.php?signout=1'><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
      </ul>
    </div>
  </nav>
  <div class="sidenav" style="position:fixed;">
    <br<br><br><br><br>
    
    <br><br><br>
    <a href="notleave.php"><span class="glyphicon glyphicon-bell"></span>&nbsp;Notifications</a><br>
    <a href="allotcourse.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Allot course</a><br>
    <a href="leaverec.php"><span class="glyphicon glyphicon-signal"></span>&nbsp;Leave Records</a>
    <br>
    
   
  </div>


  <div id="hereee" style="margin-left:250px;margin-top:80px;margin-right:80px;"></div>
    <div class="container" style="margin-left:180px;margin-top:100px;">
        <div class="row">
            <div class="col-md-12">

                <form id="candidatedata" class="form-horizontal" method="POST" role="form" action="managecourses.php">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="panel">
                            <div class="panel-heading custom-header-panel">
                                <h3 class="panel-title" style="text-align:center;"><strong>Allot course</strong></h3>
                            </div><br>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:16px;">Degree</label>
                                    <div class="col-sm-8">
                                        <select id="degree" name="degree" required class="form-control" onchange="dropoptions(this.value,'semester')">
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
                                        <select id="semester" name="semester" class="form-control" required>
                                            <option value="" disabled="" selected="">Select the semester</option>


                                        </select>
                                    </div>
                                </div><br>
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary" id="showcourses" name="showcourses" onclick='show()'>Show courses</button>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>
            </form>

        </div>

    </div>

    <div id="here" style="margin-left:240px;"></div>

    <button type="button" style="display:none;" id="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>

<div class="modal fade" id="myModal" role="dialog" style="margin-left:100px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;"><strong>See recommendations<strong></h4>
      </div>
      <div id='pick'></div>
      <div class="modal-body" id='here6' style="font-weight:normal;text-align:left;">
        <p></p>
      </div>

    </div>
  </div>
</div>
</div>
  

  

  <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    
    function dropoptions(take, id) {
            var x = document.getElementById(id);
            var count = 2;
            while (count <= x.length) {
                x.remove(x.length - 1);
            }
            const d = new Date();
            if (d.getMonth() + 1 >= 7 && d.getMonth() + 1 <= 12) {
                if (take == 1) {
                    count = 1;
                    while (count <= 10) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                } else if (take == 2) {
                    count = 1;
                    while (count <= 6) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                } else {
                    count = 1;
                    while (count <= 4) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                }
            } else {
                if (take == 1) {
                    count = 2;
                    while (count <= 10) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                } else if (take == 2) {
                    count = 2;
                    while (count <= 6) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                } else {
                    count = 2;
                    while (count <= 4) {
                        var option = document.createElement("option");
                        option.text = count.toString();
                        x.add(option, x[count]);
                        count += 2;
                    }
                }
            }

        }

function show1(take){
    var degree = document.getElementById('degree').value;
    var semester = document.getElementById('semester').value;

    
    if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
                        document.getElementById('here6').innerHTML = this.responseText;
            document.getElementById('button').click();
            var table = document.getElementById('couuTable');
          var temp = 1;
          for (var i = 1; i < table.rows.length; i++) {
            var cells = table.rows[i];
            cells.getElementsByTagName('button')[0].id = temp.toString();
            temp = temp + 1;
           
          }
          temp = 1;
					}
				};
				xmlhttp.open("GET","allc.php?degree="+degree+"&semester="+semester+"&take="+take,true);
		xmlhttp.send();
        
}

function show(){
  var degree = document.getElementById('degree').value;
  var semester = document.getElementById('semester').value;
  if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById('here').innerHTML = this.responseText;
            var table = document.getElementById('couTable');
          var temp = 1;
          for (var i = 1; i < table.rows.length; i++) {
            var cells = table.rows[i];
            cells.getElementsByTagName('button')[0].id = temp.toString();
            temp = temp + 1;
           
          }
          temp = 1;
					}
				};
				xmlhttp.open("GET","showdean.php?degree="+degree+"&semester="+semester,true);
		xmlhttp.send();

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

function show3(take){
    if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById('pick').innerHTML = this.responseText;
            

					}
				};
				xmlhttp.open("GET","function10.php?take="+take,true);
		xmlhttp.send();
}

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    alert('HEfcr');
    var value = $(this).val().toLowerCase();
    $("#couTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
  </script>

</body>

</html>