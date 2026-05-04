<?php
session_start();
include "db/config.php";

$user_id = $_SESSION['user_id'] ?? 0;
$today = date("Y-m-d");

/* GET VALUES */
$weight = $_POST['weight'] ?? 0;
$water  = $_POST['water_intake'] ?? 0; // ✅ FIXED
$steps  = $_POST['steps'] ?? 0;
$notes  = $_POST['notes'] ?? "";

/* CHECK IF TODAY ENTRY EXISTS */
$check = mysqli_query($conn,"
SELECT id FROM progress_history 
WHERE user_id='$user_id' 
AND DATE(created_at)=CURDATE()
");

if(mysqli_num_rows($check) > 0){

    mysqli_query($conn,"
    UPDATE progress_history 
    SET 
        weight='$weight',
        water_intake='$water',
        steps='$steps',
        notes='$notes'
    WHERE user_id='$user_id'
    AND DATE(created_at)=CURDATE()
    ");

}else{

    mysqli_query($conn,"
    INSERT INTO progress_history
    (user_id,weight,water_intake,steps,notes,created_at)
    VALUES
    ('$user_id','$weight','$water','$steps','$notes',NOW())
    ");
}

header("Location: track_progress.php");
exit();
?>