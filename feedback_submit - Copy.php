<?php 
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Read form inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    $sql = "INSERT INTO feedback (name, email, service, message, rating, status)
            VALUES ('$name', '$email', '$service', '$message', '$rating', 'pending')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Thank you for your feedback! Your review will be published after admin approval.');
            window.location='feedback.php';
        </script>";
    } else {
        echo "<script>
            alert('Error submitting feedback.');
            window.history.back();
        </script>";
    }
}
?>
