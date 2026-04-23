<?php
session_start();

session_unset();
session_destroy();

// Redirect to main home page
header("Location: ../index.html");
exit();
?>