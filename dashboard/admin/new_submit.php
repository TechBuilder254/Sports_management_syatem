<?php
require '../../include/db_conn.php';  // Ensure this is correctly included
page_protect();  // Protect the page, ensuring only authenticated users can access

// Retrieve form data
$membership_id = mysqli_real_escape_string($con, $_POST['m_id']);
$name = mysqli_real_escape_string($con, $_POST['u_name']);
$street_name = mysqli_real_escape_string($con, $_POST['street_name']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$dob = mysqli_real_escape_string($con, $_POST['dob']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$jdate = mysqli_real_escape_string($con, $_POST['jdate']);
$plan_id = mysqli_real_escape_string($con, $_POST['plan']);

// You can add more validation here to ensure data integrity

// Check if the membership ID already exists
$check_query = "SELECT * FROM users WHERE userid = '$membership_id'";
$check_result = mysqli_query($con, $check_query);
if (mysqli_num_rows($check_result) > 0) {
    // Membership ID already exists
    echo "The Membership ID already exists. Please choose a different ID.";
    exit();
}

// Prepare an insert query for user data
$query = "INSERT INTO users (userid, username, gender, mobile, email, dob, joining_date) 
          VALUES ('$membership_id', '$name', '$gender', '$mobile', '$email', '$dob', '$jdate')";

if (mysqli_query($con, $query)) {
    echo "New user registered successfully.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>