<?php
include "../db/config.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM exercise_plans WHERE id='$id'");

header("Location:view_exercise.php");
?>