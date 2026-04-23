<?php
session_start();
include "../php/connect.php";

// If already logged in, redirect
if (isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['admin'] = $row['email'];
            $_SESSION['LAST_ACTIVITY'] = time();

            header("Location: admin_dashboard.php");
            exit();

        } else {
            $error = "Wrong Password!";
        }

    } else {
        $error = "You are not authorized as Admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width:400px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Admin Login</h3>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" class="form-control mb-3" placeholder="Admin Email" required>

                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
