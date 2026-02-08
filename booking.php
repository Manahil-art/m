<?php
include "db.php";
session_start();

/* ================= SERVICE DATA ================= */

/* ================= SERVICE DATA (FROM DB) ================= */

$service = $_GET['service'] ?? '';

/* Fetch service name */
$service_safe = mysqli_real_escape_string($conn, $service);

$service_q = mysqli_query(
    $conn,
    "SELECT service_name 
     FROM services 
     WHERE service_key='$service_safe' 
     AND status='active'"
);

$service_row = mysqli_fetch_assoc($service_q);
$service_display = $service_row['service_name'] ?? $service;

/* Fetch subservices */
$subservices = [];

$sub_q = mysqli_query(
    $conn,
    "SELECT subservice_name 
     FROM subservices 
     WHERE service_key='$service_safe' 
     AND status='active'"
);

while ($row = mysqli_fetch_assoc($sub_q)) {
    $subservices[] = $row['subservice_name'];
}

$service_subservices = $subservices;


/* ================= FETCH REVIEWS (SERVICE-WISE) ================= */

$service_safe = mysqli_real_escape_string($conn, $service);

$feedback = mysqli_query(
    $conn,
    "SELECT name, rating, message, submitted_at
     FROM feedback
     WHERE status='approved'
     AND service='$service_safe'
     ORDER BY id DESC
     LIMIT 10"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book <?php echo htmlspecialchars($service_display); ?></title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<?php include "navbar.php"; ?>

<div class="container booking-layout">

    <!-- ================= LEFT : BOOKING FORM ================= -->
    <div class="booking-left">

        <div class="booking-header">
           
            <h1>Book <?php echo htmlspecialchars($service_display); ?></h1>
            <p>Fill in the details below to schedule your service</p>
        </div>

        <form action="save_booking.php" method="POST" class="booking-form">

            <input type="hidden" name="service" value="<?php echo htmlspecialchars($service); ?>">

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text"
                           name="phone"
                           id="phone"
                           maxlength="11"
                           pattern="03[0-9]{9}"
                           placeholder="03000000000"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> Address</label>
                <textarea name="address" rows="3" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-tasks"></i> Sub-Service</label>
                    <select name="subservice" required>
                        <option value="">Select Sub-Service</option>
                        <?php foreach ($service_subservices as $sub): ?>
                            <option value="<?php echo htmlspecialchars($sub); ?>">
                                <?php echo htmlspecialchars($sub); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar-alt"></i> Preferred Date</label>
                    <input type="date"
                           name="date"
                           min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Preferred Time</label>
                <select name="time" required>
                    <option value="">Select Time</option>
                    <option value="09:00">09:00 AM - 10:00 AM</option>
                    <option value="10:00">10:00 AM - 11:00 AM</option>
                    <option value="11:00">11:00 AM - 12:00 PM</option>
                    <option value="12:00">12:00 PM - 01:00 PM</option>
                    <option value="14:00">02:00 PM - 03:00 PM</option>
                    <option value="15:00">03:00 PM - 04:00 PM</option>
                    <option value="16:00">04:00 PM - 05:00 PM</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i> Confirm Booking
                </button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

        </form>
    </div>

    <!-- ================= RIGHT : REVIEWS ================= -->
    <div class="booking-right">
        <h2><i class="fas fa-comment-dots"></i> Reviews</h2>

        <div class="reviews-grid">
            <?php while ($row = mysqli_fetch_assoc($feedback)): ?>
                <?php
                    $stars =
                        str_repeat("<i class='fas fa-star'></i>", (int)$row['rating']) .
                        str_repeat("<i class='far fa-star'></i>", 5 - (int)$row['rating']);
                ?>

                <div class="review-card">
                    <strong><?php echo htmlspecialchars($row['name']); ?></strong>

                    <div class="review-stars">
                        <?php echo $stars; ?>
                    </div>

                    <p>"<?php echo htmlspecialchars($row['message']); ?>"</p>

                    <small>
                        <i class="far fa-clock"></i>
                        <?php echo date('M d, Y', strtotime($row['submitted_at'])); ?>
                    </small>
                </div>
            <?php endwhile; ?>

            <?php if (mysqli_num_rows($feedback) == 0): ?>
                <p class="no-reviews">No reviews for this service yet.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- ================= JS ================= -->
<script>
document.getElementById('phone').addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 11);
});
</script>

</body>
<?php include 'footer.php'; ?>
</html>
