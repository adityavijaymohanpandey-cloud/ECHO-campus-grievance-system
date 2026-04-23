<?php
include "connect.php";

$email = $_POST['email'];

$sql = "SELECT * FROM complaints WHERE email='$email'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complaint Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Your Complaints</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['category']."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No complaints found</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <a href="../dashboard.html" class="btn btn-secondary">Back</a>
</div>

</body>
</html>
