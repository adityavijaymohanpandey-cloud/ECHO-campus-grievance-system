<?php
session_start();
include "../php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Only fetch admin users
    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            // ✅ SET ADMIN SESSION CORRECTLY
            $_SESSION['admin'] = $user['email'];
            $_SESSION['LAST_ACTIVITY'] = time();

            header("Location: admin_dashboard.php");
            exit();

        } else {
            echo "<script>alert('Wrong Password'); window.location.href='admin_login.php';</script>";
        }

    } else {
        echo "<script>alert('Admin not found'); window.location.href='admin_login.php';</script>";
    }
}
?>
