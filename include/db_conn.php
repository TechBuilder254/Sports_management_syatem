<?php
$host     = "localhost"; // Host name 
$username = "root"; // MySQL username 
$password = ""; // MySQL password 
$db_name  = "sports_club_db"; // Database name 

// Connect to server and select database.
$con = mysqli_connect($host, $username, $password, $db_name, 3307);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); // Exit the script if the connection fails
}
?>

<?php
function page_protect()
{
    // Start session only if it is not already active
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    global $db;
    
    /* Secure against Session Hijacking by checking user agent */
    if (isset($_SESSION['HTTP_USER_AGENT'])) {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
            session_destroy();
            echo "<meta http-equiv='refresh' content='0; url=../login/'>";
            exit();
        }
    }
    
    // Before we allow sessions, we need to check authentication key - ckey and ctime stored in database
    
    /* If session not set, check for cookies set by Remember me */
    if (!isset($_SESSION['user_data']) && !isset($_SESSION['logged']) && !isset($_SESSION['auth_level'])) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0; url=../login/'>";
        exit();
    }
}
?>