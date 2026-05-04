<?php
include "../db/config.php";

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM exercise_videos WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$title=$_POST['title'];
$url=$_POST['url'];
$category=$_POST['category'];
$difficulty=$_POST['difficulty'];
$goal=$_POST['goal'];

mysqli_query($conn,"UPDATE exercise_videos SET
title='$title',
video_url='$url',
category='$category',
difficulty_level='$difficulty',
goal='$goal'
WHERE id='$id'");

header("Location:view_videos.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Exercise Video</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/* CENTER */
.main{
display:flex;
flex-direction:column;
align-items:center;
padding:20px;
}
.main h2{
font-size:30px;
}

/* FORM */
.form-card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
width:100%;
max-width:500px;
}

/* GROUP */
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
.form-group input{
width:100%;
padding:6px;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
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

<h2>Edit Exercise Video</h2>

<div class="form-card">

<form method="POST">

<div class="form-group">
<label>Title</label>
<input type="text" name="title" value="<?php echo $row['title']; ?>">
</div>

<div class="form-group">
<label>Video URL</label>
<input type="text" name="url" value="<?php echo $row['video_url']; ?>">
</div>

<div class="form-group">
<label>Category</label>
<input type="text" name="category" value="<?php echo $row['category']; ?>">
</div>

<div class="form-group">
<label>Difficulty</label>
<input type="text" name="difficulty" value="<?php echo $row['difficulty_level']; ?>">
</div>

<div class="form-group">
<label>Goal</label>
<input type="text" name="goal" value="<?php echo $row['goal']; ?>">
</div>

<button class="submit-btn" name="update">Update Video</button>

</form>

</div>

</div>

</body>
</html>