<?php
include 'auth_check.php';
allowOnly('admin');
include 'db.php';



// Fetch bookings
$bookings = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id ASC")
    or die(mysqli_error($conn));

// Fetch feedback
$feedback = mysqli_query($conn, "SELECT * FROM feedback ORDER BY submitted_at ASC")
    or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "navbar.php"; ?>

<h2>Admin Dashboard</h2>
<a href="logout.php" class="btn btn-logout">Logout</a>
<a href="add_employee.php" class="btn btn-add">➕ Add Employee</a>

<!-- ================= Bookings Table ================= -->
<table>
<tr>
    <th>ID</th>
    <th>Service</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
while ($row = mysqli_fetch_assoc($bookings)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['service']}</td>
        <td>{$row['name']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['date']}</td>
        <td>{$row['time']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='update_booking.php?id={$row['id']}&action=confirm' class='btn btn-confirm'>Confirm</a>
            <a href='update_booking.php?id={$row['id']}&action=reject' class='btn btn-reject'>Reject</a>
            <a href='update_booking.php?id={$row['id']}&action=delete'
               class='btn btn-delete'
               onclick=\"return confirm('Are you sure?')\">Delete</a>
        </td>
    </tr>";
}
?>
</table>

<!-- ================= Feedback Table ================= -->
<h2>Feedback Received</h2>
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Service</th>
    <th>Rating</th>
    <th>Message</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
while ($row = mysqli_fetch_assoc($feedback)) {

    // Convert rating number to stars
    $stars = str_repeat("★", (int)$row['rating']) .
             str_repeat("☆", 5 - (int)$row['rating']);

    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['service']}</td>
        <td style='color:#f59e0b; font-size:16px;'>$stars</td>
        <td>{$row['message']}</td>
        <td>{$row['submitted_at']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='feedback_action.php?id={$row['id']}&action=approve' class='btn btn-approve'>Approve</a>
            <a href='feedback_action.php?id={$row['id']}&action=reject' class='btn btn-reject'>Reject</a>
            <a href='feedback_action.php?id={$row['id']}&action=delete'
               class='btn btn-delete'
               onclick=\"return confirm('Delete Feedback?')\">Delete</a>
        </td>
    </tr>";
}
?>
</table>
<!-- ================= Employees Table ================= -->
<h2>Employees</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Username</th>
    <th>Service</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$employees = mysqli_query($conn, "SELECT * FROM employees ORDER BY id DESC");

while ($emp = mysqli_fetch_assoc($employees)) {
    $statusBtn = $emp['status'] === 'active'
        ? "<a href='employee_action.php?id={$emp['id']}&action=deactivate' class='btn btn-reject'>Deactivate</a>"
        : "<a href='employee_action.php?id={$emp['id']}&action=activate' class='btn btn-confirm'>Activate</a>";

    echo "<tr>
        <td>{$emp['id']}</td>
        <td>{$emp['name']}</td>
        <td>{$emp['username']}</td>
        <td>{$emp['service_type']}</td>
        <td>{$emp['phone']}</td>
        <td>{$emp['status']}</td>
        <td>
            $statusBtn
            <a href='employee_action.php?id={$emp['id']}&action=delete'
               class='btn btn-delete'
               onclick=\"return confirm('Delete this employee?')\">Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
<?php include 'footer.php'; ?>
</html>
