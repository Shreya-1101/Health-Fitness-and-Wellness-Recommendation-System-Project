<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$name   = $_POST['name'];
$email  = $_POST['email'];
$age    = $_POST['age'];
$gender = $_POST['gender'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$goal   = $_POST['goal'];

// BMI CALCULATION
$height_m = $height / 100;
$bmi = round($weight / ($height_m * $height_m), 2);

if ($bmi < 18.5)      $category = "Underweight";
elseif ($bmi < 24.9)  $category = "Normal";
elseif ($bmi < 29.9)  $category = "Overweight";
else                  $category = "Obese";

$query = "
UPDATE users SET 
    name='$name',
    email='$email',
    age='$age',
    gender='$gender',
    height='$height',
    weight='$weight',
    goal='$goal',
    bmi='$bmi',
    bmi_category='$category'
WHERE id='$user_id'
";

if (mysqli_query($conn, $query)) {
    $_SESSION['user_name'] = $name;
    header("Location: edit_profile.php?success=1");
} else {
    echo "Error updating profile: " . mysqli_error($conn);
}
?>
