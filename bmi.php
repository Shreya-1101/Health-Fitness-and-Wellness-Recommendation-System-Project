<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch height & weight
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT height, weight FROM users WHERE id='$user_id'")
);

$height_cm = $user['height'];
$weight = $user['weight'];

$bmi = "";
$category = "";

if ($height_cm > 0 && $weight > 0) {

    $height_m = $height_cm / 100;
    $bmi = round($weight / ($height_m * $height_m), 2);

    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi < 25) {
        $category = "Normal";
    } elseif ($bmi < 30) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }

    mysqli_query($conn, 
        "UPDATE users SET bmi='$bmi', bmi_category='$category' WHERE id='$user_id'"
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your BMI Result</title>
    <link rel="stylesheet" href="css/plan.css">
</head>
<body>

<div class="container">

    <h1>Your BMI Result 📊</h1>
    <p class="subtitle">Based on your height and weight</p>

    <div class="section">
        <h2>📌 Your Measurements</h2>
        <p><strong>Height:</strong> <?= $height_cm ?> cm</p>
        <p><strong>Weight:</strong> <?= $weight ?> kg</p>
    </div>

    <div class="section">
        <h2>📊 Your BMI</h2>
        <p><strong>BMI Value:</strong> <?= $bmi ?></p>
        <p><strong>Category:</strong> <?= $category ?></p>
    </div>

    <div class="section">
<h2>💡 What This Means</h2>

<?php if ($category == "Underweight") { ?>

<p>
You are below the healthy weight range. Focus on a balanced, calorie-rich diet with proteins,
healthy fats, and strength training to gain weight in a healthy way.
</p>

<?php } elseif ($category == "Normal") { ?>

<p>
Great! Your BMI falls within the healthy range. Maintain your lifestyle with a balanced diet,
regular physical activity, and proper hydration.
</p>

<?php } elseif ($category == "Overweight") { ?>

<p>
You are slightly above the recommended weight range. A combination of a calorie-controlled diet,
regular walking, and moderate exercise can help you reach a healthier weight.
</p>

<?php } elseif ($category == "Obese") { ?>

<p>
Your BMI indicates obesity. It is recommended to start with a structured weight management plan,
including a nutritious low-calorie diet, regular physical activity such as walking or light
cardio, and gradual lifestyle changes.
</p>

<p>
Focus on consistency rather than quick results. Small sustainable improvements in diet,
exercise, and daily habits can significantly improve your health.
</p>

<?php } ?>

<?php if ($bmi > 30) { ?>

<p><em>
For better guidance, consider consulting a healthcare professional or certified dietician
for a personalized health and nutrition plan.
</em></p>

<?php } ?>

</div>

    <div class="section">
        <h2>✨ Quick Tips to Improve BMI</h2>
        <ul>
            <li>Stay hydrated throughout the day</li>
            <li>Eat whole, unprocessed foods</li>
            <li>Walk at least 20–30 minutes daily</li>
            <li>Include fruits and vegetables in every meal</li>
            <li>Avoid junk food, sugary drinks, and overeating</li>
        </ul>
    </div>

    <a href="dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>
