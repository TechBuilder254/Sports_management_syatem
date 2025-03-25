<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is already logged in
if (isset($_SESSION["user_data"])) {
    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] === "admin") {
            header("location:./dashboard/admin/");
            exit();
        } elseif ($_SESSION["role"] === "user") {
            header("location:./dashboard/user/");
            exit();
        }
    } else {
        // If the role is not set, destroy the session and redirect to login
        session_unset();
        session_destroy();
        header("location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sports Club | Login</title>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" type="text/css" href="./css/entypo.css">
</head>
<style>
h2 {
  color: white;
  background-image: url("blaze_back_new.png");
  width: 1366px;
  align-items: center;
}
</style>
<body>
    <center><h2 style="color:#7CFC00;font-size:30px"><br><br><br>WELCOME TO <br>SPORTS CLUB Management System <br><br><br></h2></center>
<body class="page-body login-page login-form-fall">
    
    <div id="container">
        <div class="login-container">
    
            <div class="login-header login-caret">
                <div class="login-content">
                    <a href="#" class="logo">
                        <img src="logo1.png" alt="" />
                    </a>
                    <p class="description">Dear user, log in to access the system!</p>
                    <!-- progress bar indicator -->
                    <div class="login-progressbar-indicator">
                        <h3>43%</h3>
                        <span>logging in...</span>
                    </div>
                </div>
            </div>
    
            <div class="login-progressbar">
                <div></div>
            </div>
    
            <div class="login-form">
                <div class="login-content">
                    <form action="secure_login.php" method="post" id="bb">				
                        <div class="form-group">					
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-user"></i>
                                </div>
                                <input type="text" placeholder="User ID" class="form-control" name="user_id_auth" id="textfield" data-rule-minlength="6" data-rule-required="true">
                            </div>
                        </div>				
                                                        
                        <div class="form-group">					
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-key"></i>
                                </div>
                                <input type="password" name="pass_key" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Password">
                            </div>				
                        </div>

                        <!-- Add role selection dropdown -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-users"></i>
                                </div>
                                <select name="role" class="form-control" required style="color: #000; background-color: #f9f9f9; border: 1px solid #ccc; padding: 5px;">
                                    <option value="" disabled selected style="color: #888;">Select Role</option>
                                    <option value="admin" style="color: #000;">Admin</option>
                                    <option value="user" style="color: #000;">User</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btnLogin" class="btn btn-primary">
                                Login In
                                <i class="entypo-login"></i>
                            </button>
                        </div>
                    </form>
                
                    <div class="login-bottom-links">
                        <a href="forgot_password.php" class="link">Forgot your password?</a>
                        <br>
                        <!-- Add Create Account Option -->
                        <a href="create_account.php" class="link">Create an Account</a>
                    </div>			
                </div>
            </div>
        </div>
    </div>
</body>
</html>