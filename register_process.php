<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check for duplicate user
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Username already exists. Please try another.";
} else {
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='index.php'>Click here to login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
