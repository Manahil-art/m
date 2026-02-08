
<?php
include "db.php";

// ---------------- BOOKING STATUS ----------------
$phone = '';
$bookings = [];

if (isset($_POST['check'])) {

    // normalize phone
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);

    $sql = "
        SELECT 
            b.id,
            b.service,
            b.date,
            b.time,
            b.status,
            e.name AS employee_name
        FROM bookings b
        LEFT JOIN employees e 
            ON b.service = e.service_type
        WHERE b.phone = ?
        ORDER BY b.date DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}
?>
<link rel="stylesheet" href="style.css">
<?php include "navbar.php"; ?>
<!-- BOOKING STATUS -->
<section id="booking" class="container box">
    <h2>Check Your Booking Status</h2>

    <form method="POST">
        <label>Enter Phone Number</label>
        <input type="text"
               name="phone"
               value="<?php echo htmlspecialchars($phone); ?>"
               placeholder="03000000000"
               pattern="03[0-9]{9}"
               maxlength="11"
               required>
        <button type="submit" name="check">Check Status</button>
    </form>

    <?php if (isset($_POST['check'])): ?>

        <?php if (!empty($bookings)): ?>
            <table class="status-table">
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Employee</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td>#<?php echo $b['id']; ?></td>
                    <td><?php echo htmlspecialchars($b['service']); ?></td>
                    <td><?php echo $b['date']; ?></td>
                    <td><?php echo $b['time']; ?></td>
                    <td>
                        <?php echo $b['employee_name']
                            ? htmlspecialchars($b['employee_name'])
                            : '<em>Not assigned</em>'; ?>
                    </td>
                    <td class="status-<?php echo strtolower($b['status']); ?>">
                        <?php echo ucfirst($b['status']); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>
            <p>No booking found for this phone number.</p>
        <?php endif; ?>

    <?php endif; ?>
</section>