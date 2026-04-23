<?php
session_start();

// If admin not logged in → redirect
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include "../php/connect.php";

// Fetch complaints
$sql = "SELECT * FROM complaints ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">View Complaints</span>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">Back</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <h4 class="mb-3">All Complaints</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <form action="update_status.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status" class="form-select form-select-sm">
                            <option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
                            <option value="Resolved" <?php if($row['status']=="Resolved") echo "selected"; ?>>Resolved</option>
                        </select>
                        <button type="submit" class="btn btn-success btn-sm mt-1">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

</div>

</body>
</html>
