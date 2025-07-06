<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Add Train
if (isset($_POST['add_train'])) {
    $train_name = $_POST['train_name'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $available_seats = $_POST['available_seats'];

    $sql = "INSERT INTO trains (train_name, source, destination, available_seats)
            VALUES ('$train_name', '$source', '$destination', '$available_seats')";
    $conn->query($sql);
}

// Delete Train
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM trains WHERE id=$id";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM trains");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Trains</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Manage Trains</h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="train_name" class="form-control" placeholder="Train Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="source" class="form-control" placeholder="Source" required>
        </div>
        <div class="form-group">
            <input type="text" name="destination" class="form-control" placeholder="Destination" required>
        </div>
        <div class="form-group">
            <input type="number" name="available_seats" class="form-control" placeholder="Available Seats" required>
        </div>
        <button type="submit" name="add_train" class="btn btn-primary">Add Train</button>
    </form>
    <h4 class="mt-4">Train List</h4>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Train Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Available Seats</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['train_name']; ?></td>
            <td><?php echo $row['source']; ?></td>
            <td><?php echo $row['destination']; ?></td>
            <td><?php echo $row['available_seats']; ?></td>
            <td>
                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure to delete?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
