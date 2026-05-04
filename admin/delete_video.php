<?php
include "../db/config.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM exercise_videos WHERE id='$id'");

header("Location:view_videos.php");
?>