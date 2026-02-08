<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    /* ================= ADMIN LOGIN ================= */
    if ($role === 'admin') {

        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $admin = mysqli_fetch_assoc($result);

            // If admin passwords are still plain text
            // CHANGE THIS to password_verify() once you hash them
            if ($password === $admin['password']) {
                $_SESSION['id'] = $admin['id'];
                $_SESSION['role'] = 'admin';
                header("Location: admin_dashboard.php");
                exit();
            }
        }
    }

    /* ================= EMPLOYEE LOGIN ================= */
    if ($role === 'employee') {

        $sql = "SELECT * FROM employees 
                WHERE username='$username' AND status='active'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $emp = mysqli_fetch_assoc($result);

            if (password_verify($password, $emp['password'])) {
                $_SESSION['id'] = $emp['id'];
                $_SESSION['role'] = 'employee';
                header("Location: employee_dashboard.php");
                exit();
            }
        }
    }

    /* ================= FAILED LOGIN ================= */
    header("Location: admin_login.php?error=1");
    exit();
}
