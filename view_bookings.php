<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT t.*, u.username, tr.train_name FROM tickets t
        JOIN users u ON t.user_id = u.id
        JOIN trains tr ON t.train_id = tr.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>All Bookings</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Train Name</th>
            <th>Passenger Name</th>
            <th>Seats</th>
            <th>Booking Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['train_name']; ?></td>
            <td><?php echo $row['passenger_name']; ?></td>
            <td><?php echo $row['seats']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
