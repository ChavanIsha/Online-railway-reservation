<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$result = $conn->query("SELECT id FROM users WHERE username='$username'");
$user = $result->fetch_assoc();
$user_id = $user['id'];

$sql = "SELECT t.*, tr.train_name FROM tickets t
        JOIN trains tr ON t.train_id = tr.id
        WHERE t.user_id = $user_id";
$bookings = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>My Bookings</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Train Name</th>
            <th>Passenger Name</th>
            <th>Seats</th>
            <th>Booking Date</th>
        </tr>
        <?php while ($row = $bookings->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['train_name']; ?></td>
            <td><?php echo $row['passenger_name']; ?></td>
            <td><?php echo $row['seats']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
