<?php
session_start();

$timeout_duration = 600; // 10 minutes

// If not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if session expired
if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {

    session_unset();
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit();
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Admin Dashboard</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <h4>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></h4>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Complaints</h5>
                    <p>View all submitted grievances</p>
                    <a href="view_complaints.php" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Category Wise</h5>
                    <p>Hostel / Mess / Department</p>
                    <a href="view_complaints.php" class="btn btn-secondary btn-sm">Manage</a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
