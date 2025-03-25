<?php
require './include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = uniqid('user_'); // Generate a unique user ID
    $username = mysqli_real_escape_string($con, $_POST['username']); // Use 'username' for login
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $joining_date = date('Y-m-d'); // Current date

    // Check if the username or email already exists
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<div class='error'>Username or Email already exists. Please try again.</div>";
        exit();
    }

    // Insert the new user into the database
    $query = "INSERT INTO users (userid, username, pass_key, email, joining_date, role) 
              VALUES ('$userid', '$username', '$password', '$email', '$joining_date', 'user')";

    if (mysqli_query($con, $query)) {
        echo "<div class='success'>Account created successfully. You can now <a href='index.php'>login</a>.</div>";
    } else {
        echo "<div class='error'>Error: " . $query . "<br>" . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create an Account</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Link to your existing CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(58, 36, 36);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(65, 168, 73, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create an Account</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>