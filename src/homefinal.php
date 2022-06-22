<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("1st.gif");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body>

<div class="bg">
<nav class="navbar navbar-inverse navbar-fixed-top"  >
  <div class="container-fluid"  > 
    <div class="navbar-header" >
      <p class="navbar-brand navbar-light .bg-light" href="#" style="color:white;font-size:24px;font-weight:900;"> STUDENT MANAGEMENT SYSTEM</p>
    </div>
    <ul class="nav navbar-nav" >
    <li><a></a></li>
    <li><a></a></li>
    <li><a></a></li><li><a></a></li>
      <li style="font-size:18px;"><a href="homefinal.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li style="float:right;font-size:18px;"><a id="check" ><span class="glyphicon glyphicon-log-in"></span>&nbsp;</a></li>
    </ul>
  </div>
</nav>

</div>
<script>
 var1 ="<?php session_start(); echo $_SESSION['user'];?>";
 var2 ='<?php session_start(); echo $_SESSION['role'];?>';
if(var1==""){

  
  document.getElementById("check").innerHTML += "Login";
  document.getElementById("check").href = "login.php";
}else{
  
  document.getElementById("check").innerHTML += "Back to dashboard";
  if(var2=='A'){
    document.getElementById("check").href = "admin.php";
  }else if(var2=='D'){
    document.getElementById("check").href = "dean.php";
  }else if(var2=='F'){
    document.getElementById("check").href = "faculty.php";
  }else if(var2 == 'S'){
    document.getElementById("check").href = "student.php";
  }
}
</script>

</body>
</html>
