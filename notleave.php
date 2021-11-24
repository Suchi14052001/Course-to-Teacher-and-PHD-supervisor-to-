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
    echo '<h2 style="text-align:center;font-weight:bold;margin-top:-20px;">Leave Notifications</h2><br>';
    echo '<table class="table table-bordered table-striped" id="couTable">';
    echo '<thead>
  <tr>';
    echo '<th>Faculty ID</th><th>From Date</th>
    <th>Number of days</th>
    <th>Reason</th>
    <th>Accept</th>
    <th>Deny</th>
  </tr>
  </thead>';
    echo '<tbody id="myTable">';
    $sql1 = "select * from leavescopy where rep='WAITING'";
    $result = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr><td>{$row['fid']}</td><td>{$row['fromdate']}</td><td>{$row['todate']}</td><td>{$row['reason']}</td><td><button class='btn btn-success' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;Agree</button></td><td><button class='btn btn-danger' onclick='show1(this.id);'><span class='glyphicon glyphicon-thumbs-down'></span>&nbsp;&nbsp;Deny</button></td></tr>\n";
    }
    echo "</tbody>";
    echo "</table>";
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


  <div class="main" id="Firstshow" style="margin-top:10%;margin-left:20%;">
   <!-- <h2>Sidebar Dropdown</h2>
    <p>Click on the dropdown button to open the dropdown menu inside the side navigation.</p>
    <p>This sidebar is of full height (100%) and always shown.</p>
    <p>Some random text..</p> -->
    
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

    

 if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
            document.getElementById("Firstshow").innerHTML = this.responseText;
            var table = document.getElementById('couTable');
            if (typeof(table) != 'undefined' && table != null){
	      var temp=1;
	    for(var i=1;i<table.rows.length;i++){
		    var cells = table.rows[i];
		    cells.getElementsByTagName('button')[0].id=temp.toString();
		    temp=temp+1;
            cells.getElementsByTagName('button')[1].id=temp.toString();
		    temp=temp+1;
	    }
	    temp=1;}
					}
				};
				xmlhttp.open("GET","notleave.php?check=true",true);
		xmlhttp.send();


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


function show1(take){
  if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
                        document.getElementById("Firstshow").innerHTML = this.responseText;
            var table = document.getElementById('couTable');
            if (typeof(table) != 'undefined' && table != null){
	      var temp=1;
	    for(var i=1;i<table.rows.length;i++){
		    var cells = table.rows[i];
		    cells.getElementsByTagName('button')[0].id=temp.toString();
		    temp=temp+1;
            cells.getElementsByTagName('button')[1].id=temp.toString();
		    temp=temp+1;
	    }
	    temp=1;}

					}
				};
				xmlhttp.open("GET","fleave.php?what="+take,true);
		xmlhttp.send();
}
  </script>

</body>

</html>