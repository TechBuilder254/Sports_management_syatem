<?php
include './include/db_conn.php';

$user_id_auth = ltrim($_POST['user_id_auth']);
$user_id_auth = rtrim($_POST['user_id_auth']);

$pass_key = ltrim($_POST['pass_key']);
$pass_key = rtrim($_POST['pass_key']);

$role = $_POST['role']; // Get the role from the form

$user_id_auth = stripslashes($user_id_auth);
$pass_key     = stripslashes($pass_key);

if ($pass_key == "" && $user_id_auth == "") {
    echo "<head><script>alert('Username and Password cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    exit();
} else if ($pass_key == "") {
    echo "<head><script>alert('Password cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    exit();
} else if ($user_id_auth == "") {
    echo "<head><script>alert('Username cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    exit();
} else {
    $user_id_auth = mysqli_real_escape_string($con, $user_id_auth);

    // Query based on role and username
    $sql = "SELECT * FROM users WHERE username='$user_id_auth' AND role='$role'";
    $result = mysqli_query($con, $sql);

    // Debugging: Print the query and the result
    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }

    echo "Query: $sql<br>"; // Debugging: Print the query
    echo "Number of rows: " . mysqli_num_rows($result) . "<br>"; // Debugging: Print the number of rows

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Debugging: Print the hashed password from the database
        echo "Hashed Password from DB: " . $row['pass_key'] . "<br>";

        // Verify the hashed password
        if (password_verify($pass_key, $row['pass_key'])) {
            session_start();
            $_SESSION['user_data']  = $row['userid']; // Store the unique user ID
            $_SESSION['logged']     = "start";
            $_SESSION['full_name']  = $row['username']; // Use 'username' from the database
            $_SESSION['role']       = $row['role']; // Store role in session

            // Redirect based on role
            if ($role === 'admin') {
                header("location: ./dashboard/admin/");
            } else if ($role === 'user') {
                header("location: ./dashboard/user/");
            }
            exit();
        } else {
            echo "<html><head><script>alert('Invalid Password');</script></head></html>";
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
            exit();
        }
    } else {
        echo "<html><head><script>alert('Invalid Username or Role');</script></head></html>";
        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        exit();
    }
}
?>