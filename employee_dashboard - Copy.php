<?php
include 'auth_check.php';
allowOnly('employee');
include 'db.php';

$employee_id = $_SESSION['id'];

// Get employee service type
$empQuery = mysqli_query($conn, "SELECT service_type, name FROM employees WHERE id='$employee_id'");
$emp = mysqli_fetch_assoc($empQuery);
$serviceType = $emp['service_type'];
$empName = $emp['name'];

// Fetch related bookings
$sql = "SELECT * FROM bookings 
        WHERE service='$serviceType' 
        AND status IN ('confirmed','in_progress')
        ORDER BY date, time ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<h2>Welcome, <?= $empName ?></h2>
<p><strong>Service:</strong> <?= $serviceType ?></p>

<table>
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Phone</th>
    <th>Date</th>
    <th>Adress</th>
    <th>Time</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['date'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $row['time'] ?></td>
    <td><?= ucfirst($row['status']) ?></td>
    <td>
        <?php if ($row['status'] === 'confirmed') { ?>
            <a href="employee_booking_action.php?id=<?= $row['id'] ?>&action=start"
               class="btn btn-confirm">Start</a>
        <?php } ?>

        <?php if ($row['status'] === 'in_progress') { ?>
            <a href="employee_booking_action.php?id=<?= $row['id'] ?>&action=complete"
               class="btn btn-confirm">Complete</a>

            <a href="employee_booking_action.php?id=<?= $row['id'] ?>&action=cancel"
               class="btn btn-reject"
               onclick="return confirm('Cancel this booking?')">Cancel</a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

<a href="logout.php" class="btn btn-logout">Logout</a>

<?php include 'footer.php'; ?>

</body>
</html>
