<?php
include "../php/connect.php";

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE complaints SET status='$status' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: view_complaints.php");
} else {
    echo "Status update failed";
}
?>
