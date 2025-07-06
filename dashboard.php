<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p><a href="trains.php" class="btn btn-info">View Trains & Book Tickets</a></p>
    <p><a href="my_bookings.php" class="btn btn-success">My Bookings</a></p>
    <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
</body>
</html>
