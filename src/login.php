<!DOCTYPE html>

<?php 
session_start();
date_default_timezone_set("Asia/Kolkata");
include("connection.php");
if (!empty($_POST)) {
    if (isset($_POST['login'])) {
        $user = $_POST['username']; 
        $pa = $_POST['password']; 
        $sql1 = "select * from login where username='$user'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count==1){
            //user is found
            if($row['block']==0){
                //found user is not blocked
                $sql1 = "select * from login where username='$user' and password='$pa'";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);
                if($count==1){
                    //correct password
                    $update_query = "UPDATE login SET unsuccessfulLogins=0 WHERE username='$user' and password='$pa'";
                    $result = mysqli_query($conn, $update_query);
                    $update_query = "UPDATE login SET block=0 WHERE username='$user'";
                    $result = mysqli_query($conn, $update_query);
                    $role = $row['role'];
                    $_SESSION["user"] = $user;
                    $_SESSION["pass"] = $pa;
                    $_SESSION["role"] = $row['role'];
                    if ($role == 'S') {
                        echo "<script> window.location.href='student.php';</script>";
                    } else if ($role == 'F') {
                        echo "<script> window.location.href='faculty.php';</script>";
                    } else if ($role == 'A') {
                        echo "<script> window.location.href='admin.php';</script>";
                    } else if ($role == 'D') {
                        echo "<script> window.location.href='dean.php';</script>";
                    }
                    if (isset($_POST['remember'])) {
                        setcookie('username', $user, time() + (86400 * 30));
                    }
                    
                }else{
                    //wrong password
                    $sql1 = "select * from login where username='$user'";
                    $result = mysqli_query($conn, $sql1);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $temp = $row['unsuccessfulLogins']+1;
                    $update_query = "UPDATE login SET unsuccessfulLogins='$temp' WHERE username='$user'";
                    $result = mysqli_query($conn, $update_query);
                    $update_query = "UPDATE login SET lastloggedin=now() WHERE username='$user'";
                    $result = mysqli_query($conn, $update_query);
                    if($temp>=3){
                        //Unsuccessful attempts touched 3
                        date_default_timezone_set("Asia/Kolkata");
                        $date1 = date_create(date("Y-m-d H:i:s"));
                        $date2 = date_create($row['lastloggedin']);
                        $diff=date_diff($date1,$date2);
                        $show = $diff->format("%h");
                        if($show>=1){
                            //More than an hour from last unsuccessful attempt
                            $update_query = "UPDATE login SET block=0 WHERE username='$user'";
                            $result = mysqli_query($conn, $update_query);
                            $update_query = "UPDATE login SET unsuccessfulLogins=1 WHERE username='$user'";
                            $result = mysqli_query($conn, $update_query);
                            echo "<html>";
                            echo "<body><div class='container'> <div class='alert alert-danger alert-dismissible' style='margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Invalid password! Account will be blocked for a day after 3 unsuccessful login attempts</strong>
                            </div></div></body>";
                            echo "</html>";
                        }else{
                            //Block
                            $update_query = "UPDATE login SET block=1 WHERE username='$user'";
                            $result = mysqli_query($conn, $update_query);
                            $update_query = "UPDATE login SET blockdate=now() WHERE username='$user'";
                            $result = mysqli_query($conn, $update_query);
                            $update_query = "UPDATE login SET unsuccessfulLogins=3 WHERE username='$user'";
                            $result = mysqli_query($conn, $update_query);
                            echo "<html>";
                            echo "<body><div class='container'> <div class='alert alert-danger alert-dismissible' style='margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Your account is blocked! It will be unblocked in 23 hours 59 minutes 59 seconds from now</strong>
                            </div></div></body>";
                            echo "</html>";
                        }
                        
                    }else{
                        //Don't block
                        $update_query = "UPDATE login SET block=0 WHERE username='$user'";
                        $result = mysqli_query($conn, $update_query);
                        echo "<html>";
                        echo "<body><div class='container'> <div class='alert alert-danger alert-dismissible' style='margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Invalid password! Account will be blocked for a day after 3 unsuccessful login attempts</strong>
                        </div></div></body>";
                        echo "</html>";
                    }
                }
            }else{
                //found user is blocked
                date_default_timezone_set("Asia/Kolkata");
                $date1=date_create(date("Y-m-d H:i:s"));
                $date2=date_create($row['blockdate']);
                $diff=date_diff($date1,$date2);
                $temp = $diff->format("%a");
                if ($temp==0) {
                    //not more than a day
                    $date1 = date_create($row['blockdate']);
                    date_default_timezone_set("Asia/Kolkata");
                    $date1 = date_add($date1, date_interval_create_from_date_string('1 day'));
                    $date2=date_create(date("Y-m-d H:i:s"));
                    $diff=date_diff($date1,$date2);
                    $show = $diff->format("%h hours %i minutes %s seconds");
                    echo "<html>";
                    echo '<body><div class="container"><div class="alert alert-danger alert-dismissible" style="margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Your account is currently blocked because of 3 unsuccessful login attempts.</strong> It will be unblocked in ';
                    echo $show.' from now';
                    echo '</div></div></body>';
                    echo "</html>";
                }else{
                    //been more than a day
                    $update_query = "UPDATE login SET unsuccessfulLogins=0 WHERE username='$user'";
                    $result = mysqli_query($conn, $update_query);
                    $update_query = "UPDATE login SET block=0 WHERE username='$user'";
                    $result = mysqli_query($conn, $update_query);
                    $sql1 = "select * from login where username='$user' and password='$pa'";
                    $result = mysqli_query($conn, $sql1);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $count = mysqli_num_rows($result);
                    if($count==1){
                        //entered right password
                        $role = $row['role'];
                        $_SESSION["user"] = $user;
                        $_SESSION["pass"] = $pa;
                        $_SESSION["role"] = $row['role'];
                        if ($role == 'S') {
                            echo "<script> window.location.href='student.php';</script>";
                        } else if ($role == 'F') {
                            echo "<script> window.location.href='faculty.php';</script>";
                        } else if ($role == 'A') {
                            echo "<script> window.location.href='admin.php';</script>";
                        } else if ($role == 'D') {
                            echo "<script> window.location.href='dean.php';</script>";
                        }
                        if (isset($_POST['remember'])) {
                            setcookie('username', $user, time() + (86400 * 30));
                        }
                    }else{
                        //wrong password
                        $update_query = "UPDATE login SET unsuccessfulLogins=1 WHERE username='$user'";
                        $result = mysqli_query($conn, $update_query);
                        $update_query = "UPDATE login SET lastloggedin=now() WHERE username='$user'";
                        $result = mysqli_query($conn, $update_query);
                        echo "<html>";
                        echo "<body><div class='container'> <div class='alert alert-danger alert-dismissible' style='margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Invalid password! Account will be blocked for a day after 3 unsuccessful login attempts</strong>
                        </div></div></body>";
                        echo "</html>";
                    }
                }
            }
        }else{
            //user is not found
            echo "<html>";
            echo "<body><div class='container'> <div class='alert alert-danger alert-dismissible' style='margin-top:100px;margin-left:170px;margin-right:100px;position:absolute;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>User not found!</strong>
            </div></div></body>";
            echo "</html>";
        }
    }
}
?> 



<html>
   

<head>
    <title> Login page </title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("2nd.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

</style>
</head>
<!------ Include the above in your HEAD tag ---------->

<body style="position:relative;">


<div class="bg">

    <div class="container my-4 ">
        <nav class="navbar navbar-inverse navbar-fixed-top bg-success">
            <div class="container-fluid bg-success">
                <div class="navbar-header">
                    <p class="navbar-brand" style="color:black;font-size:24px;font-weight:900;"> STUDENT MANAGEMENT SYSTEM</p>
                </div>
                <ul class="nav navbar-nav" style="float:right;color:black;">
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li style="font-size:17px;color:black;"><a style="color:black;text-decoration:underline;" class="pick" href="homefinal.php">Back to home page</a></li>
                </ul>
            </div>
        </nav>

        <div id="loginbox" style="margin-top:180px;margin-left:270px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="text-align:center;font-weight:900;font-size:20px;" name="login" id="login">Login</div>
                </div>

                <div style="padding-top:30px" class="panel-body">

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form action="login.php" id="loginform" class="form-horizontal" role="form" method="POST">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" value="<?php
                                                                                                                if (isset($_COOKIE["username"])) {
                                                                                                                    echo $_COOKIE["username"];
                                                                                                                } ?>" required placeholder="Enter your username">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" required name="password" placeholder="Enter your password">
                        </div>



                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>
                        </div>
<br>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls" style="left:15%;position:absolute;">
                                <input type="submit" style="width:30%;" id="login" name="login" class="btn btn-primary" value="Login">
                            </div>
                            <div class="col-sm-12 controls" style="left:55%;position:absolute;">
                                <input type="reset" id="clear"  style="width:30%;" name="clear" class="btn btn-danger" value="Clear">
                            </div>
                        </div>
                        <br>



                    </form>



                </div>
            </div>
        </div>
        </div>


</body>
</html>