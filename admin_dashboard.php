<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Admin Dashboard</h2>
    <p><a href="manage_trains.php" class="btn btn-info">Manage Trains</a></p>
    <p><a href="view_bookings.php" class="btn btn-success">View All Bookings</a></p>
    <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
</body>
</html>
