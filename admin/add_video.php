<?php
include "../db/config.php";

if(isset($_POST['add'])){

$title = $_POST['title'];
$url = $_POST['video_url'];
$category = $_POST['category'];
$difficulty = $_POST['difficulty'];
$goal = $_POST['goal'];

$query = "INSERT INTO exercise_videos
(title, video_url, category, difficulty_level, goal)
VALUES
('$title','$url','$category','$difficulty','$goal')";

mysqli_query($conn,$query);

header("Location:view_videos.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Exercise Video</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/* CENTER FORM */
.main{
display:flex;
flex-direction:column;
align-items:center;
padding:20px;
}
.main h2{
font-size:30px;
}

/* FORM CARD */
.form-card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
width:100%;
max-width:500px;
}

/* FORM GROUP */
.form-group{
margin-bottom:12px;
}

.form-group label{
font-weight:600;
display:block;
margin-bottom:4px;
font-size:18px;
}

/* INPUT */
.form-group input,
.form-group select{
width:100%;
padding:6px;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
}

/* TEXTAREA SMALL */

textarea{
height:55px;   /* 🔥 compact */
resize:none;
}

/* BUTTON */
.submit-btn{
display:block;
margin:10px auto 0;
background:#2e8b57;
color:white;
padding:7px 16px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:18px;
font-family:inherit;
}

h2{
margin-bottom:15px;
font-size:20px;
}

</style>

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
<div class="main">

<h2>Add Exercise Video</h2>

<div class="form-card">

<form method="POST">

<div class="form-group">
<label>Title</label>
<input type="text" name="title" required>
</div>

<div class="form-group">
<label>Video URL</label>
<input type="text" name="video_url" required>
</div>

<div class="form-group">
<label>Category</label>
<input type="text" name="category" required>
</div>

<div class="form-group">
<label>Difficulty</label>
<select name="difficulty">
<option>Beginner</option>
<option>Intermediate</option>
<option>Advanced</option>
</select>
</div>

<div class="form-group">
<label>Goal</label>
<select name="goal">
<option>Weight Loss</option>
<option>Gain</option>
<option>Maintain</option>
<option>Stay Fit</option>
</select>
</div>

<button class="submit-btn" name="add">Add Video</button>

</form>

</div>

</div>

</body>
</html>