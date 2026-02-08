<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "navbar.php"; ?>

<section class="container">
    <h2>Send Your Feedback</h2>
    <form action="feedback_submit.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
       <select name="service">
    <option value="">Select Service (optional)</option>
    <option value="Home">Home Services</option>
    <option value="Appliance">Appliance Services</option>
    <option value="Vehicle">Vehicle Services</option>
    <option value="Beauty">Beauty Services</option>
    <option value="IT">IT & Tech Services</option>
</select>

        <label class="rating-label">Rate Our Service</label>

<div class="rating-wrapper">
    <input type="range" name="rating" min="1" max="5" value="3" step="1" id="ratingRange">
    <span id="ratingValue">3</span> / 5
</div>
        <textarea name="message" placeholder="Your Feedback" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
</section>
<script>
const slider = document.getElementById("ratingRange");
const output = document.getElementById("ratingValue");

output.innerText = slider.value;

slider.oninput = function () {
    output.innerText = this.value;
};
</script>

</body>
<?php include 'footer.php'; ?>
</html>
