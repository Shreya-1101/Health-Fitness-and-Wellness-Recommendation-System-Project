<?php
session_start();
include "db/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$today = date("Y-m-d");

/* FETCH TODAY DATA */
$result = mysqli_query($conn,"
SELECT * FROM progress_history
WHERE user_id='$user_id' 
AND DATE(created_at)='$today'
");

$data = mysqli_fetch_assoc($result);

$weight = $data['weight'] ?? "";
$water  = $data['water_intake'] ?? 0;
$steps  = $data['steps'] ?? 0;
$notes  = $data['notes'] ?? "";

/* CALCULATIONS */
$steps_goal = 15000;
$steps_percent = ($steps_goal > 0) ? min(100, ($steps/$steps_goal)*100) : 0;

$water_goal = 5;
$water_percent = ($water_goal > 0) ? min(100, ($water/$water_goal)*100) : 0;

$goal_percent = round(($steps_percent + $water_percent)/2);

/* STREAK */
$streak = 0;
$prevDate = date("Y-m-d");

$streakQuery = mysqli_query($conn,"
SELECT DATE(created_at) as date 
FROM progress_history
WHERE user_id='$user_id'
ORDER BY created_at DESC
");

while($row = mysqli_fetch_assoc($streakQuery)){
    if($row['date'] == $prevDate){
        $streak++;
        $prevDate = date("Y-m-d", strtotime($prevDate . " -1 day"));
    } else {
        break;
    }
}

/* CHART DATA */
$chartQuery = mysqli_query($conn,"
SELECT DATE(created_at) as date, steps, water_intake 
FROM progress_history 
WHERE user_id='$user_id'
ORDER BY created_at DESC 
LIMIT 7
");

$dates = [];
$stepsData = [];
$waterData = [];

while($row = mysqli_fetch_assoc($chartQuery)){
    $dates[] = $row['date'];
    $stepsData[] = $row['steps'];
    $waterData[] = $row['water_intake'];
}

$dates = array_reverse($dates);
$stepsData = array_reverse($stepsData);
$waterData = array_reverse($waterData);
?>

<!DOCTYPE html>
<html>

<head>
<title>Track Progress | BeWell</title>
<link rel="stylesheet" href="css/track.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<script>
function addWater(amount) {
    const input = document.getElementById("waterInput");
    let current = parseFloat(input.value) || 0;
    current += amount;
    input.value = current.toFixed(2);
}
</script>

<body>

<div class="container">

<h1>📈 Progress Dashboard</h1>
<p class="subtitle">Track your daily health</p>

<!-- STREAK -->
<div class="card center">
🔥 <strong><?= $streak ?> Day Streak</strong>
</div>

<!-- FORM START -->
<form action="save_daily_progress.php" method="POST">

<!-- INPUT -->
<div class="card">
<h3>📝 Daily Entry</h3>

<div class="grid">

<div class="field">
<label>Weight (kg)</label>
<input type="number" step="0.1" name="weight" value="<?= $weight ?>">
</div>

<div class="field">
<label>Water Intake</label>
<div class="water-container">
<input type="number" step="0.1" id="waterInput" name="water_intake" value="<?= $water ?>">
<div class="water-buttons">
<button type="button" onclick="addWater(0.25)">+250ml</button>
<button type="button" onclick="addWater(0.5)">+500ml</button>
<button type="button" onclick="addWater(1)">+1L</button>
</div>
</div>
</div>

<div class="field">
<label>Steps</label>
<input type="number" name="steps" value="<?= $steps ?>">
</div>

</div>
</div>

<!-- PROGRESS -->
<div class="progress-grid">

<div class="card">
<h3>🚶 Steps</h3>
<p><?= $steps ?>/<?= $steps_goal ?></p>
<div class="progress-bar">
<div class="progress-fill" style="width:<?= $steps_percent ?>%"></div>
</div>
</div>

<div class="card">
<h3>💧 Water</h3>
<p><?= $water ?>/<?= $water_goal ?>L</p>
<div class="progress-bar">
<div class="water-fill" style="width:<?= $water_percent ?>%"></div>
</div>
</div>

</div>

<!-- GOAL -->
<div class="card">
<h3>🎯 Goal Completion</h3>
<p><?= round($goal_percent) ?>%</p>
<div class="progress-bar">
<div class="progress-fill" style="width:<?= $goal_percent ?>%"></div>
</div>
</div>

<!-- GRAPH -->
<div class="progress-row">

<div class="card half">
<h3>🚶 Steps Progress</h3>
<canvas id="stepsChart"></canvas>
</div>

<div class="card half">
<h3>💧 Water Progress</h3>
<canvas id="waterChart"></canvas>
</div>

</div>

<!-- NOTES AT BOTTOM -->
<div class="card">
<h3>📝 Notes</h3>

<div class="field">
<textarea name="notes"><?= $notes ?></textarea>
</div>

</div>

<!-- SINGLE SAVE BUTTON -->
<button class="save-btn">Save Progress</button>

</form>

<a href="dashboard.php" class="back">← Back to Dashboard</a>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

/* STEPS CHART */
new Chart(document.getElementById('stepsChart'), {
type: 'line',
data: {
labels: <?= json_encode($dates) ?>,
datasets: [{
label: 'Steps',
data: <?= json_encode($stepsData) ?>,
borderColor: '#3498db',
backgroundColor: 'rgba(52,152,219,0.2)',
fill: true,
tension: 0.4
}]
},
options: {
responsive: true,
plugins: {
legend: { display: false }
}
}
});

/* WATER CHART */
new Chart(document.getElementById('waterChart'), {
type: 'line',
data: {
labels: <?= json_encode($dates) ?>,
datasets: [{
label: 'Water (L)',
data: <?= json_encode($waterData) ?>,
borderColor: '#2ecc71',
backgroundColor: 'rgba(46,204,113,0.2)',
fill: true,
tension: 0.4
}]
},
options: {
responsive: true,
plugins: {
legend: { display: false }
}
}
});

});
</script>

</body>
</html>