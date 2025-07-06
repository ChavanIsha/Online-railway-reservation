<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch trains
$trains = $conn->query("SELECT * FROM trains");

// Book Ticket
if (isset($_POST['book_ticket'])) {
    $train_id = $_POST['train_id'];
    $passenger_name = $_POST['passenger_name'];
    $seats = $_POST['seats'];

    $username = $_SESSION['username'];
    $result = $conn->query("SELECT id FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    $conn->query("INSERT INTO tickets (user_id, train_id, passenger_name, seats)
                  VALUES ('$user_id', '$train_id', '$passenger_name', '$seats')");

    $conn->query("UPDATE trains SET available_seats = available_seats - $seats WHERE id=$train_id");

    echo "<script>alert('Ticket Booked Successfully'); window.location='my_bookings.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Train Tickets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Available Trains</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Train Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Available Seats</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $trains->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['train_name']; ?></td>
            <td><?php echo $row['source']; ?></td>
            <td><?php echo $row['destination']; ?></td>
            <td><?php echo $row['available_seats']; ?></td>
            <td>
                <form method="POST" class="form-inline">
                    <input type="hidden" name="train_id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="passenger_name" class="form-control mr-2" placeholder="Passenger Name" required>
                    <input type="number" name="seats" class="form-control mr-2" placeholder="Seats" min="1" max="<?php echo $row['available_seats']; ?>" required>
                    <button type="submit" name="book_ticket" class="btn btn-success">Book</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
