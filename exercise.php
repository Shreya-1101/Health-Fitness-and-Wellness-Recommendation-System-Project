<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT bmi_category, goal FROM users WHERE id='$user_id'")
);

$bmi_category = $user['bmi_category'];
$goal = $user['goal'];

$result = mysqli_query($conn,
"SELECT * FROM exercise_plans 
WHERE bmi_category='$bmi_category' 
AND goal='$goal'"
);

$ex = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>Your Exercise Plan | BeWell</title>
<link rel="stylesheet" href="css/plan.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>

.timeline{
margin-top:30px;
display:flex;
flex-direction:column;
gap:25px;
}

.workout-card{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
border-left:6px solid #2d6a4f;
}

.workout-card h2{
margin-bottom:10px;
color:#2d6a4f;
}

.action{
text-align:center;
margin-top:30px;
}

</style>

</head>

<body>

<div class="container">

<h1>Your Personalized Exercise Plan 🏋️</h1>

<p class="subtitle">
Based on your BMI Category:
<strong><?= htmlspecialchars($bmi_category) ?></strong>
& Goal:
<strong><?= htmlspecialchars($goal) ?></strong>
</p>

<?php if ($ex) { ?>

<div class="timeline">

<!-- WARMUP -->

<div class="workout-card">

<h2>🧘 Warm-Up (5 Minutes)</h2>

<ul>
<li>Neck rotations – 10 reps</li>
<li>Arm circles – 10 reps</li>
<li>Torso twists – 10 reps</li>
<li>Light jogging – 1 minute</li>
</ul>

</div>


<!-- MAIN WORKOUT -->

<div class="workout-card">

<h2>🔥 Main Workout</h2>

<p><strong>Exercises:</strong></p>

<p><?= nl2br(htmlspecialchars($ex['exercises'])); ?></p>

<p><strong>Duration:</strong> <?= htmlspecialchars($ex['duration']); ?></p>

</div>


<!-- COOLDOWN -->

<div class="workout-card">

<h2>😌 Cooldown (5 Minutes)</h2>

<ul>
<li>Hamstring stretch – 20 sec</li>
<li>Shoulder stretch – 20 sec</li>
<li>Child pose – 30 sec</li>
<li>Deep breathing – 10 breaths</li>
</ul>

</div>

</div>


<div class="action">

<h3 style="margin-bottom:10px;color:#2d6a4f;">🎥 Exercise Video Guidance</h3>

<p style="max-width:650px;margin:auto;color:#555;line-height:1.6;">
To help you perform these exercises correctly, we recommend watching guided workout videos. 
These videos demonstrate proper form, technique, and pacing so you can complete each exercise 
safely and effectively.
</p>

<br>

<a href="exercise_videos.php" class="save-btn">
🎥 Watch Exercise Videos
</a>

</div>

<?php } else { ?>

<div class="workout-card">
<p>No exercise plan found for your category.</p>
</div>

<?php } ?>


<div class="action">

<a href="dashboard.php" class="back">
← Back to Dashboard
</a>

</div>

</div>

</body>
</html>