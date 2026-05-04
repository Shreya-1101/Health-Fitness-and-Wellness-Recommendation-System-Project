<?php
include "../db/config.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM diet_plans WHERE id='$id'");

header("Location:view_diet.php");

?>