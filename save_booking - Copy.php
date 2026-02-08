<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check required fields
    foreach ($_POST as $value) {
        if (empty($value)) {
            die("All fields are required");
        }
    }

    $service = $_POST['service'];
    $subservice = $_POST['subservice'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO bookings 
        (service, subservice, name, phone, address, date, time)
        VALUES 
        ('$service', '$subservice', '$name', '$phone', '$address', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        // Booking successful → show alert and redirect
        echo "<script>
            alert('Booking Confirmed!\\nService: $service\\nSub-Service: $subservice\\nDate: $date\\nTime: $time');
            window.location.href='index.php';
        </script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
