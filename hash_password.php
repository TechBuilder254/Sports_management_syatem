<?php
// Replace 'your_password_here' with the password you want to hash
$password = '1234'; // Example: 'admin123'
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo "Original Password: " . $password . "<br>";
echo "Hashed Password: " . $hashed_password;
?>