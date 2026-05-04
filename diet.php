<?php $is_pdf = isset($_GET['pdf']); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* GET USER BMI + GOAL */
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT bmi_category, goal FROM users WHERE id='$user_id'")
);

$bmi_category = $user['bmi_category'];
$goal = $user['goal'];

/* GET HEALTH PROFILE */
$healthQuery = mysqli_query($conn,"SELECT * FROM health_profile WHERE user_id='$user_id'");
$health = mysqli_fetch_assoc($healthQuery);

/* DIET PLAN QUERY */
$dietQuery = "SELECT * FROM diet_plans 
WHERE bmi_category='$bmi_category' 
AND goal='$goal'";

/* Health filtering */
if ($health) {
    if ($health['has_diabetes'] == 1) {
        $dietQuery .= " AND suitable_for_diabetes=1";
    }
    if ($health['has_high_bp'] == 1) {
        $dietQuery .= " AND suitable_for_high_bp=1";
    }
    if ($health['has_cholesterol'] == 1) {
        $dietQuery .= " AND suitable_for_cholesterol=1";
    }
}

$dietQuery .= " LIMIT 1";

$result = mysqli_query($conn,$dietQuery);
$diet = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Your Diet Plan | BeWell</title>

<link rel="stylesheet" href="css/plan.css?v=1.1">

<style>
.title-row{
position:relative;
text-align:center;
margin-bottom:10px;
}

.title-row .title{
margin:0;
}

.download-btn{
position:absolute;
right:0;
top:50%;
transform:translateY(-50%);
background:#2e8b57;
color:white;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
font-size:14px;
}

.download-btn:hover{
background:#256f47;
}
</style>

</head>

<body>

<div class="container">

<!-- TITLE + DOWNLOAD BUTTON -->
<div class="title-row">

<h1 class="title">
<?= $is_pdf ? "Your Personalized Diet Plan" : "Your Personalized Diet Plan 🥗" ?>
</h1>

<?php if(!$is_pdf){ ?>
<a href="download_diet.php" class="download-btn">⬇ Download Diet Plan</a>
<?php } ?>

</div>

<p class="subtitle">
Based on your BMI Category:
<strong><?= $bmi_category ?></strong>
& Goal:
<strong><?= $goal ?></strong>
</p>

<p class="subtitle">
Health Conditions:
BP: <?= ($health && $health['has_high_bp']) ? "Yes" : "No" ?> |
Diabetes: <?= ($health && $health['has_diabetes']) ? "Yes" : "No" ?> |
Cholesterol: <?= ($health && $health['has_cholesterol']) ? "Yes" : "No" ?>
</p>

<?php if ($diet) { ?>

<div class="section">

<h2><?= $is_pdf ? "Daily Meal Plan" : "🍽️ Daily Meal Plan" ?></h2>

<div class="meal-grid">

<div class="meal-card breakfast">
<h4><?= $is_pdf ? "Breakfast" : "🌅 Breakfast" ?></h4>
<p><?= nl2br($diet['breakfast']); ?></p>
</div>

<div class="meal-card lunch">
<h4><?= $is_pdf ? "Lunch" : "🍛 Lunch" ?></h4>
<p><?= nl2br($diet['lunch']); ?></p>
</div>

<div class="meal-card snacks">
<h4><?= $is_pdf ? "Evening Snacks" : "🥜 Evening Snacks" ?></h4>
<p><?= nl2br($diet['snacks']); ?></p>
</div>

<div class="meal-card dinner">
<h4><?= $is_pdf ? "Dinner" : "🌙 Dinner" ?></h4>
<p><?= nl2br($diet['dinner']); ?></p>
</div>

</div>

</div>

<div class="section">

<h2><?= $is_pdf ? "Portion Guidance" : "🍱 Portion Guidance" ?></h2>

<ul>
<li>½ plate: Vegetables (salad, sabzi)</li>
<li>¼ plate: Protein (dal, paneer, chicken, eggs)</li>
<li>¼ plate: Carbs (roti, brown rice, oats)</li>
</ul>

</div>

<div class="section">

<h2><?= $is_pdf ? "Hydration Recommendations" : "🥤 Hydration Recommendations" ?></h2>

<ul>
<li>Drink at least 6–8 glasses of water daily</li>
<li>Start your day with warm lemon water</li>
<li>Avoid sugary packaged juices</li>
</ul>

</div>

<div class="section">

<h2><?= $is_pdf ? "Healthy Eating Tips" : "✨ Healthy Eating Tips" ?></h2>

<ul>
<li>Eat slowly and mindfully</li>
<li>Don’t skip breakfast</li>
<li>Avoid junk food & fried food</li>
<li>Include fruits daily</li>
<li>Limit tea/coffee</li>
</ul>

</div>

<?php } else { ?>

<div class="section">
<p>No diet plan found for your category.</p>
</div>

<?php } ?>

<!-- BACK BUTTON (UNCHANGED) -->
<?php if(!$is_pdf){ ?>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<?php } ?>

</div>

</body>
</html>