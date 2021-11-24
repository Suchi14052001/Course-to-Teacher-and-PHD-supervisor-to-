<!DOCTYPE html>

<html>

<head>
    <title> Faculty page </title>
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

<body>
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
        <br<br><br><br><br><br>

            <br>
            <a href="#"><span class="glyphicon glyphicon-bell"></span>&nbsp;Notifications</a><br>
            <a href="applyleave.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Apply Leave</a>
            <br>

            <a href="teachpref.php"><span class="glyphicon glyphicon-check"></span>&nbsp;Teaching preference</a>
    </div>
    <div id="hereee" style="margin-left:250px;margin-top:80px;margin-right:80px;"></div>
    <div class="container" style="margin-left:180px;margin-top:100px;">
        <div class="row">
            <div class="col-md-12">

                <form id="candidatedata" class="form-horizontal" method="POST" role="form" action="managecourses.php">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="panel">
                            <div class="panel-heading custom-header-panel">
                                <h3 class="panel-title" style="text-align:center;"><strong>Teaching Preference</strong></h3>
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

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
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
        function show5() {
            var check = getCookie('file');
            window.location.href = "viewcourses.php?url=" + check;
        }

        function show1(take) {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "viewcourses.php?url=" + this.responseText;

                }
            };
            xmlhttp.open("GET", "ff.php?what=" + take + "&who=" + 's', true);
            xmlhttp.send();
        }

        function show() {
            var deg = document.getElementById('degree').value;
            var sem = document.getElementById('semester').value;

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("received response");
                    document.getElementById('here').innerHTML = this.responseText;
                    var table = document.getElementById('couTable');
                    var temp = 1;
                    for (var i = 1; i < table.rows.length; i++) {
                        var cells = table.rows[i];
                        cells.getElementsByTagName('input')[0].id = temp.toString();
                        temp = temp + 1;
                        cells.getElementsByTagName('span')[0].id = temp.toString();
                        temp = temp + 1;
                    }
                    temp = 1;

                }
            };
            xmlhttp.open("GET", "ajaxx.php?deg=" + deg + "&sem=" + sem, true);
            xmlhttp.send();
        }

        function see(id) {
            var te = (parseInt(id) + 1).toString();

            document.getElementById(te).innerHTML = document.getElementById(id.toString()).value;
        }

        function savepref() {
            var deg = document.getElementById("degree").value;
            var sem = document.getElementById("semester").value;
            var num = document.getElementById('couTable').rows.length;
            var tosend = [];
            for (var j = 1; j <= num; j++) {
                tosend.push(document.getElementById(j.toString()).value);
            }
            tosend = JSON.stringify(tosend);
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("hereee").innerHTML = this.responseText;

                }
            };
            xmlhttp.open("GET", "fff.php?deg=" + deg + "&sem=" + sem + "&num=" + tosend, true);
            xmlhttp.send();

        }
    </script>

</body>

</html>