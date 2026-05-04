<?php
include "../db/config.php";

if(isset($_POST['add'])){

$bmi = $_POST['bmi'];
$goal = $_POST['goal'];
$breakfast = $_POST['breakfast'];
$lunch = $_POST['lunch'];
$dinner = $_POST['dinner'];
$snacks = $_POST['snacks'];

/* checkbox values */
$diabetes = isset($_POST['diabetes']) ? 1 : 0;
$high_bp = isset($_POST['high_bp']) ? 1 : 0;
$cholesterol = isset($_POST['cholesterol']) ? 1 : 0;

$query = "INSERT INTO diet_plans(
bmi_category,goal,breakfast,lunch,dinner,snacks,
suitable_for_diabetes,suitable_for_high_bp,suitable_for_cholesterol
)

VALUES(
'$bmi','$goal','$breakfast','$lunch','$dinner','$snacks',
'$diabetes','$high_bp','$cholesterol'
)";

mysqli_query($conn,$query);

header("Location:view_diet.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Diet Plan</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/* CENTER MAIN */
.main{
padding:30px;
display:flex;
flex-direction:column;
align-items:center;
}
.main h2{
font-size:30px;
}

/* FORM CARD */
.form-card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
width:90%;
max-width:1000px;
}

/* GRID */
form{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
}

/* FULL WIDTH */
.full-width{
grid-column:span 2;
}

/* FORM GROUP */
.form-group{
display:flex;
flex-direction:column;
}

.form-group label{
margin-bottom:5px;
font-weight:600;
font-size:18px;
}

/* INPUT */
.form-group input,
.form-group select{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
}

/* TEXTAREA */
.form-group textarea{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
min-height:70px;
resize:vertical;
}

/* CHECKBOX */
.checkbox-group{
display:flex;
gap:20px;
flex-wrap:wrap;
}

/* BUTTON */
.submit-btn{
grid-column:span 2;
margin-top:10px;
background:#2e8b57;
color:white;
padding:10px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:18px;
font-family:inherit;
}

.submit-btn:hover{
background:#256f46;
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

<h2 class="page-title">Add Diet Plan</h2>

<div class="form-card">

<form method="POST">

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
<label>Breakfast</label>
<textarea name="breakfast"></textarea>
</div>

<div class="form-group full-width">
<label>Lunch</label>
<textarea name="lunch"></textarea>
</div>

<div class="form-group full-width">
<label>Dinner</label>
<textarea name="dinner"></textarea>
</div>

<div class="form-group full-width">
<label>Evening Snacks</label>
<textarea name="snacks"></textarea>
</div>

<div class="form-group full-width">
<label>Suitable For Health Conditions</label>

<div class="checkbox-group">
<label><input type="checkbox" name="diabetes"> Diabetes</label>
<label><input type="checkbox" name="high_bp"> High BP</label>
<label><input type="checkbox" name="cholesterol"> Cholesterol</label>
</div>

</div>

<button class="submit-btn" name="add">Add Diet</button>

</form>

</div>

</div>

</body>
</html>