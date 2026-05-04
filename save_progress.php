<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$type  = $_POST['type'];
$value = $_POST['value'];

if($type == "weight"){

mysqli_query($conn,"
INSERT INTO progress_history(user_id,weight,recorded_at)
VALUES('$user_id','$value',NOW())
");

}

elseif($type == "bmi"){

mysqli_query($conn,"
INSERT INTO progress_history(user_id,bmi,recorded_at)
VALUES('$user_id','$value',NOW())
");

}

elseif($type == "water_intake"){

mysqli_query($conn,"
INSERT INTO progress_history(user_id,water_intake,recorded_at)
VALUES('$user_id','$value',NOW())
");

}

elseif($type == "steps"){

mysqli_query($conn,"
INSERT INTO progress_history(user_id,steps,recorded_at)
VALUES('$user_id','$value',NOW())
");

}

header("Location: track_progress.php");
exit();
?>