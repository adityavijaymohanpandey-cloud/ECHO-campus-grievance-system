<?php
include "connect.php";
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if(password_verify($password, $row['password'])) {

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['email'] = $row['email'];

        if($row['role'] == "admin") {
            header("Location: ../admin/admin_dashboard.php");
        } else {
            header("Location: ../dashboard.html");
        }

    } else {
        echo "Invalid Password";
    }

} else {
    echo "User not found";
}
?>
