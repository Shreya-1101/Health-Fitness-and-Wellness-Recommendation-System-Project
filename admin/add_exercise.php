<?php
include "../db/config.php";

if(isset($_POST['add'])){

$bmi=$_POST['bmi'];
$goal=$_POST['goal'];
$exercise=$_POST['exercise'];
$duration=$_POST['duration'];
$intensity=$_POST['intensity'];

$query="INSERT INTO exercise_plans
(bmi_category,goal,exercises,duration,intensity_level)
VALUES
('$bmi','$goal','$exercise','$duration','$intensity')";

mysqli_query($conn,$query);

header("Location:view_exercise.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Exercise Plan</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/* CENTER MAIN */
.main{
display:flex;
flex-direction:column;
align-items:center;
padding:20px;
font-size:30px;
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
max-width:500px;   /* 🔥 compact width */
}

/* FORM GROUP */
.form-group{
margin-bottom:12px;   /* 🔥 less spacing */
}

.form-group label{
font-weight:600;
margin-bottom:4px;
display:block;
font-size:18px;
}

/* INPUT */
.form-group input,
.form-group select,
.form-group textarea{
width:100%;
padding:6px;   /* 🔥 smaller height */
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

/* TITLE */
h2{
margin-bottom:15px;
font-size:20px;
}

</style>

</head>

<body>

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

<div class="main">

<h2>Add Exercise Plan</h2>

<div class="form-card">

<form method="POST">

<div class="form-grid">

<div class="form-group">
<label>BMI Category</label>
<select name="bmi">
<option>Underweight</option>
<option>Normal</option>
<option>Overweight</option>
<option>Obese</option>
</select>
</div>

<div class="form-group">
<label>Goal</label>
<select name="goal">
<option>Weight Gain</option>
<option>Stay Fit</option>
<option>Weight Loss</option>
</select>
</div>

<div class="form-group full-width">
<label>Exercises</label>
<textarea name="exercise"></textarea>
</div>

<div class="form-group">
<label>Duration</label>
<input type="text" name="duration" placeholder="30 minutes">
</div>

<div class="form-group">
<label>Intensity Level</label>
<select name="intensity">
<option>Low</option>
<option>Medium</option>
<option>High</option>
</select>
</div>

</div>

<button class="submit-btn" name="add">Add Exercise</button>

</form>

</div>

</div>

</body>
</html>