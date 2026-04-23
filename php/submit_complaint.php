<?php
session_start();
include "connect.php";

$email = $_POST['email'];
$category = $_POST['category'];
$description = $_POST['description'];
$status = "Pending";

$sql = "INSERT INTO complaints (email, category, description, status)
        VALUES ('$email', '$category', '$description', '$status')";

if (mysqli_query($conn, $sql)) {
    
    // Redirect to user dashboard after successful submission
    header("Location: ../dashboard.html");
    exit();

} else {
    echo "Error submitting complaint: " . mysqli_error($conn);
}
?>