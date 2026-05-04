<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$high_bp = isset($_POST['high_bp']) ? 1 : 0;
$diabetes = isset($_POST['diabetes']) ? 1 : 0;
$cholesterol = isset($_POST['cholesterol']) ? 1 : 0;
$other = mysqli_real_escape_string($conn, $_POST['other_conditions']);

// Check if profile already exists
$check = mysqli_query($conn, "SELECT * FROM health_profile WHERE user_id = $user_id");

if (mysqli_num_rows($check) > 0) {

    mysqli_query($conn, "
        UPDATE health_profile 
        SET has_high_bp = $high_bp,
            has_diabetes = $diabetes,
            has_cholesterol = $cholesterol,
            other_conditions = '$other'
        WHERE user_id = $user_id
    ");

} else {

    mysqli_query($conn, "
        INSERT INTO health_profile (user_id, has_high_bp, has_diabetes, has_cholesterol, other_conditions)
        VALUES ($user_id, $high_bp, $diabetes, $cholesterol, '$other')
    ");
}

header("Location: dashboard.php");
exit();
?>
