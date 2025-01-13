<?php
require '../../include/db_conn.php';
page_protect();

$uid = $_POST['uid'];
$uname = $_POST['uname'];
$gender = $_POST['gender'];
$mobile = $_POST['phone'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$jdate = $_POST['jdate'];
$stname = $_POST['stname'];
$state = $_POST['state'];
$city = $_POST['city'];
$zipcode = $_POST['zipcode'];
$calorie = $_POST['calorie'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$fat = $_POST['fat'];
$remarks = $_POST['remarks'];

// Update users table
$query1 = "UPDATE users SET username='$uname', gender='$gender', mobile='$mobile', email='$email', dob='$dob', joining_date='$jdate' WHERE userid='$uid'";
if (mysqli_query($con, $query1)) {
    // Check if entry exists in address table
    $check_address = "SELECT * FROM address WHERE id='$uid'";
    $result_address = mysqli_query($con, $check_address);
    if (mysqli_num_rows($result_address) > 0) {
        // Update address table
        $query2 = "UPDATE address SET streetName='$stname', state='$state', city='$city', zipcode='$zipcode' WHERE id='$uid'";
    } else {
        // Insert into address table
        $query2 = "INSERT INTO address (id, streetName, state, city, zipcode) VALUES ('$uid', '$stname', '$state', '$city', '$zipcode')";
    }
    if (mysqli_query($con, $query2)) {
        // Check if entry exists in health_status table
        $check_health = "SELECT * FROM health_status WHERE uid='$uid'";
        $result_health = mysqli_query($con, $check_health);
        if (mysqli_num_rows($result_health) > 0) {
            // Update health_status table
            $query3 = "UPDATE health_status SET calorie='$calorie', height='$height', weight='$weight', fat='$fat', remarks='$remarks' WHERE uid='$uid'";
        } else {
            // Insert into health_status table
            $query3 = "INSERT INTO health_status (uid, calorie, height, weight, fat, remarks) VALUES ('$uid', '$calorie', '$height', '$weight', '$fat', '$remarks')";
        }
        if (mysqli_query($con, $query3)) {
            echo "<html><head><script>alert('Member Update Successfully');</script></head></html>";
            echo "<meta http-equiv='refresh' content='0; url=view_mem.php'>";
        } else {
            echo "<html><head><script>alert('ERROR! Update Operation Unsuccessful');</script></head></html>";
            echo "error: " . mysqli_error($con);
        }
    } else {
        echo "<html><head><script>alert('ERROR! Update Operation Unsuccessful');</script></head></html>";
        echo "error: " . mysqli_error($con);
    }
} else {
    echo "<html><head><script>alert('ERROR! Update Operation Unsuccessful');</script></head></html>";
    echo "error: " . mysqli_error($con);
}
?>