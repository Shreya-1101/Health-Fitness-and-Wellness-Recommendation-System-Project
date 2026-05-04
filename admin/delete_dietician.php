<?php
include "../db/config.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM dieticians WHERE id='$id'");

header("Location:view_dieticians.php");
?>