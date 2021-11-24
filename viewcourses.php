<!DOCTYPE html>
<?php
$file = $_GET["url"];

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>
<html>
<head>
<title>View courses</title>
<style>

* {
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
.jumbotron {
  padding-top: 10px !important;
  padding-bottom: 10px !important;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</head>

<body>
<div class="jumbotron text-center">
  <h2 style="font-weight:bold;">Courses list</h2>
  <p>Search in the search bar with any value as filter</p>
</div>
<br>
<input class="form-control " id="myInput" type="text" placeholder="Search here with any value as filter.." style="width:80%;left:10%;position:absolute;">
  <br>
<!-- <div class='container'> <div class='alert alert-success alert-dismissible' id="status" style='margin-top:100px;margin-left:170px;display:none;margin-right:100px;position:absolute;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            
                            </div></div>-->
                            <p id="ff"></p>
                            <br>
<div id="res"></div>


<script>
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("res").innerHTML = this.responseText;
        var table = document.getElementById('couTable');
	      var temp=1;
	    for(var i=1;i<table.rows.length;i++){
		    var cells = table.rows[i];
		    cells.getElementsByTagName('button')[0].id=temp.toString();
		    temp=temp+1;
	    }
	    temp=1;
			}
		};
		xmlhttp.open("GET","function.php?role="+'A'+"&what="+'course',true);
		xmlhttp.send();

    function show1(id){
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
				xmlhttp.open("GET","function2.php?which="+id,true);
		xmlhttp.send();
    }

    $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#couTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

</body>
</html>