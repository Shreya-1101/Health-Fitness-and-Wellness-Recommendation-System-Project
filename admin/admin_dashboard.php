<?php
include "../db/config.php";

/* COUNT DATA */
$diet_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM diet_plans"));
$exercise_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM exercise_plans"));
$video_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM exercise_videos"));
$dietician_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dieticians"));
$user_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$plan_history_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_plan_history"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link rel="stylesheet" href="admin_css/admin.css">

</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

<h2>BeWell Admin</h2>

<a href="admin_dashboard.php">Dashboard</a>
<a href="view_diet.php">Manage Diet Plans</a>
<a href="view_exercise.php">Manage Exercise Plans</a>
<a href="view_videos.php">Manage Exercise Videos</a>
<a href="view_dieticians.php">Manage Dieticians</a>
<a href="plan_history.php">Users Plan History</a>
<a href="users.php">Users</a>
<a href="../logout.php">Logout</a>

</div>

<!-- Main -->
<div class="main dashboard-main">

<!-- TOP BAR -->
<div class="dashboard-top">

<h1>Admin Dashboard</h1>

<div class="top-right">
👤 Welcome Admin <br>
</div>

</div>

<!-- STATS -->
<div class="stats">

<div class="stat-box">
<h2><?php echo $diet_count; ?></h2>
<p>🍎 Diet Plans</p>
</div>

<div class="stat-box">
<h2><?php echo $exercise_count; ?></h2>
<p>🏋️ Exercise Plans</p>
</div>

<div class="stat-box">
<h2><?php echo $video_count; ?></h2>
<p>🎥 Videos</p>
</div>

<div class="stat-box">
<h2><?php echo $dietician_count; ?></h2>
<p>👩‍⚕️ Dieticians</p>
</div>

<div class="stat-box">
<h2><?php echo $user_count; ?></h2>
<p>👤 Users</p>
</div>

</div>

<!-- MAIN CARDS -->
<div class="dashboard-cards">

<div class="dashboard-card">
<h3>🍎 Diet Plans</h3>
<p>Manage diet recommendations</p>
<a href="view_diet.php">Open</a>
</div>

<div class="dashboard-card">
<h3>🏋️ Exercise Plans</h3>
<p>Manage exercise programs</p>
<a href="view_exercise.php">Open</a>
</div>

<div class="dashboard-card">
<h3>🎥 Exercise Videos</h3>
<p>Manage video library</p>
<a href="view_videos.php">Open</a>
</div>

<div class="dashboard-card">
<h3>👩‍⚕️ Dieticians</h3>
<p>Manage dietician profiles</p>
<a href="view_dieticians.php">Open</a>
</div>

<div class="dashboard-card">
<h3>👤 Users</h3>
<p>View registered users</p>
<a href="users.php">View</a>
</div>

<div class="dashboard-card">
<h3>📊 Plan History</h3>
<p>View user plan history</p>
<a href="plan_history.php">View</a>
</div>

</div>

</div>

</body>
</html>