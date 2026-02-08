<?php
include 'auth_check.php';
allowOnly('admin');
include 'db.php';

/* ================= FETCH SERVICES FROM DB ================= */
$services = mysqli_query(
    $conn,
    "SELECT service_key, service_name 
     FROM services 
     WHERE status='active'"
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $rawPassword = $_POST['password'];
    $service = $_POST['service'];
    $phone = $_POST['phone'];

    $password = password_hash($rawPassword, PASSWORD_DEFAULT);

    // 1️⃣ Check username
    $checkUser = mysqli_query(
        $conn,
        "SELECT id FROM employees WHERE username='$username'"
    );

    if (mysqli_num_rows($checkUser) > 0) {
        $error = "Username already exists!";
    }
    else {

        // 2️⃣ Check service already assigned
        $checkService = mysqli_query(
            $conn,
            "SELECT id FROM employees WHERE service_type='$service'"
        );

        if (mysqli_num_rows($checkService) > 0) {
            $error = "This service already has an assigned employee!";
        }
        else {

            // 3️⃣ Insert employee
            $sql = "INSERT INTO employees 
                    (name, username, password, service_type, phone, status)
                    VALUES 
                    ('$name', '$username', '$password', '$service', '$phone', 'active')";

            if (mysqli_query($conn, $sql)) {
                $success = "Employee added successfully!";
            } else {
                $error = "Error adding employee!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<h2>Add Employee</h2>

<!-- Messages -->
<?php
if (isset($success)) {
    echo "<p style='color:green;'>$success</p>";
}
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST" style="max-width:400px;">

    <input type="text" name="name" placeholder="Employee Name" required>

    <input type="text" name="username" placeholder="Username" required>

    <input type="password" name="password" placeholder="Password" required>

    <!-- ✅ FIXED SERVICE DROPDOWN -->
    <select name="service" required>
        <option value="">-- Select Service Type --</option>

        <?php while ($row = mysqli_fetch_assoc($services)) { ?>
            <option value="<?= $row['service_key'] ?>">
                <?= $row['service_name'] ?>
            </option>
        <?php } ?>
    </select>

    <input type="text" name="phone" placeholder="Phone Number" required>

    <button type="submit">Add Employee</button>
</form>

<a href="admin_dashboard.php">← Back to Dashboard</a>

<?php include 'footer.php'; ?>

</body>
</html>
