<!DOCTYPE html>


<html>

<head>
  <title> Manage students </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
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
<body>
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
  <div class="sidenav" style="position:fixed;">
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


  <div class="main" id="managestudents">
    <br>

    <div style="margin-top:50px" class="form-group">

    
      <div class="col-sm-12 controls" style="left:890px;position:absolute;">
        <button type="button" style="width:200px;" id="newstudent" name="newstudent" class="btn btn-primary" onclick="newcourse('newstudent.php');"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;<strong>New Student</strong></button>
      </div>
    </div>



    <div class="container" style="left:34%;margin-top:100px;">
      <div class="row">
        <div class="col-md-12">

          <form id="candidatedata" class="form-horizontal" method="POST" role="form" action="managestudents.php">
            <div class="col-md-offset-2 col-md-8">
              <div class="panel">
                <div class="panel-heading custom-header-panel">
                  <h3 class="panel-title" style="text-align:center;"><strong>Manage Students</strong></h3>
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
                    <button type="button" class="btn btn-primary" id="showcourses" name="showcourses" onclick='show();'>Show Students</button>
                  </div>

                </div>

              </div>
            </div>
        </div>
        </form>

      </div>

    </div>

  </div>
  <p id="res" style="margin-top:25px;margin-left:230px;font-size:14px;background-color:white;"></p>

  <button type="button" style="display:none;" id="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>

  <div class="modal fade" id="myModal" role="dialog" style="margin-left:50px;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;"><strong>Student update form<strong></h4>
        </div>
        <div class="modal-body" id='here' style="margin-left:-110px;font-weight:normal;text-align:left;">
          <p></p>
        </div>

      </div>
    </div>
  </div>
  </div>

</body>
<script>
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

function show(){
  var deg = document.getElementById('degree').value;
  var sem = document.getElementById('semester').value;
  if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById('res').innerHTML = this.responseText;
            var table = document.getElementById('couTable');
          var temp = 1;
          for (var i = 1; i < table.rows.length; i++) {
            var cells = table.rows[i];
            cells.getElementsByTagName('button')[0].id = temp.toString();
            temp = temp + 1;
            cells.getElementsByTagName('button')[1].id = temp.toString();
            temp = temp + 1;
          }
          temp = 1;
					}
				};
				xmlhttp.open("GET","ajax1.php?deg="+deg+"&sem="+sem,true);
		xmlhttp.send();
}

function show1(id){
  var deg = document.getElementById('degree').value;
  var sem = document.getElementById('semester').value;
  if (id % 2 != 0) {
    if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //var mywindow = window.open('editcourse.php', '_blank', 'location=yes,resizable=no,left=260,height=600,width=920,scrollbars=yes,status=yes,titlebar=yes,top=70');
            document.getElementById('here').innerHTML = this.responseText;
            document.getElementById('button').click();

          }
        };
      
        
        xmlhttp.open("GET", "editstudent.php?which=" + id + "&degree=" + deg +"&semester="+ sem+ "&role=" + 'a', true);
        xmlhttp.send();
  }else{
    if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //var mywindow = window.open('editcourse.php', '_blank', 'location=yes,resizable=no,left=260,height=600,width=920,scrollbars=yes,status=yes,titlebar=yes,top=70');
            document.getElementById('res').innerHTML = this.responseText;
          var table = document.getElementById('couTable');
          var temp = 1;
          for (var i = 1; i < table.rows.length; i++) {
            var cells = table.rows[i];
            cells.getElementsByTagName('button')[0].id = temp.toString();
            temp = temp + 1;
            cells.getElementsByTagName('button')[1].id = temp.toString();
            temp = temp + 1;
          }
          temp = 1;
          }
        };
      
        
        xmlhttp.open("GET", "ajax2.php?which=" + id + "&degree=" + deg +"&semester="+ sem+ "&role=" + 'a', true);
        xmlhttp.send();
  }
}

function show4(){
  console.log('In show() function');
  var sid = document.getElementById('sid').value;
  var sname = document.getElementById('sname').value;
  var email = document.getElementById('email').value;
  var phone = document.getElementById('phone').value;
 if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById('heree').innerHTML = this.responseText;

            console.log('Received XML response');

					}
				};
				xmlhttp.open("GET","function5.php?sid="+sid+"&sname="+sname+"&email="+email+"&phone="+phone,true);
		        xmlhttp.send();
}

    function newcourse(filename) {

var mywindow = window.open(filename, '_blank', 'location=yes,resizable=no,left=260,height=600,width=920,scrollbars=yes,status=yes,titlebar=yes,top=70');
}

</script>
</html>