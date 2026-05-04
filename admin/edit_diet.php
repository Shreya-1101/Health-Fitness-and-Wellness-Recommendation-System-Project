<?php
include "../db/config.php";

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM diet_plans WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$bmi=$_POST['bmi'];
$goal=$_POST['goal'];
$breakfast=$_POST['breakfast'];
$lunch=$_POST['lunch'];
$dinner=$_POST['dinner'];
$snacks=$_POST['snacks'];

$diabetes = isset($_POST['diabetes']) ? 1 : 0;
$high_bp = isset($_POST['high_bp']) ? 1 : 0;
$cholesterol = isset($_POST['cholesterol']) ? 1 : 0;

mysqli_query($conn,"UPDATE diet_plans SET
bmi_category='$bmi',
goal='$goal',
breakfast='$breakfast',
lunch='$lunch',
dinner='$dinner',
snacks='$snacks',
suitable_for_diabetes='$diabetes',
suitable_for_high_bp='$high_bp',
suitable_for_cholesterol='$cholesterol'
WHERE id='$id'");

header("Location:view_diet.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Diet Plan</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/* MAIN FIX */
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
.form-container{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
width:90%;
max-width:1000px;
}

/* GRID */
.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
}

/* FULL WIDTH */
.full-width{
grid-column:span 2;
}

/* INPUT */
.form-group{
display:flex;
flex-direction:column;
}

.form-group label{
font-weight:600;
margin-bottom:5px;
display:block;
font-size:18px;
}

.form-group input,
.form-group textarea,
.form-group select{
padding:8px;
border:1px solid #ccc;
border-radius:5px;
font-size:14px;
}

/* TEXTAREA SMALL */
.form-group textarea{
height:60px;
resize:none;
}

/* CHECKBOX INLINE */
.checkbox-group{
display:flex;
gap:20px;
margin-top:5px;
}

/* BUTTON */
.form-btn{
display:block;
margin:15px auto 0;
background:#2e8b57;
color:white;
padding:8px 18px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:18px;
font-family:inherit;
}

.form-btn:hover{
background:#256f47;
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

<h2 class="page-title">Edit Diet Plan</h2>

<div class="form-container">

<form method="POST">

<div class="form-grid">

<!-- BMI -->
<div class="form-group">
<label>BMI Category</label>
<select name="bmi">
<option <?= $row['bmi_category']=="Underweight"?"selected":"" ?>>Underweight</option>
<option <?= $row['bmi_category']=="Normal"?"selected":"" ?>>Normal</option>
<option <?= $row['bmi_category']=="Overweight"?"selected":"" ?>>Overweight</option>
<option <?= $row['bmi_category']=="Obese"?"selected":"" ?>>Obese</option>
</select>
</div>

<!-- GOAL -->
<div class="form-group">
<label>Goal</label>
<select name="goal">
<option <?= $row['goal']=="Weight Gain"?"selected":"" ?>>Weight Gain</option>
<option <?= $row['goal']=="Stay Fit"?"selected":"" ?>>Stay Fit</option>
<option <?= $row['goal']=="Weight Loss"?"selected":"" ?>>Weight Loss</option>
</select>
</div>

<!-- BREAKFAST -->
<div class="form-group full-width">
<label>Breakfast</label>
<textarea name="breakfast"><?= $row['breakfast'] ?></textarea>
</div>

<!-- LUNCH -->
<div class="form-group full-width">
<label>Lunch</label>
<textarea name="lunch"><?= $row['lunch'] ?></textarea>
</div>

<!-- DINNER -->
<div class="form-group full-width">
<label>Dinner</label>
<textarea name="dinner"><?= $row['dinner'] ?></textarea>
</div>

<!-- SNACKS -->
<div class="form-group full-width">
<label>Evening Snacks</label>
<textarea name="snacks"><?= $row['snacks'] ?></textarea>
</div>

<!-- CHECKBOX -->
<div class="form-group full-width">
<label>Suitable For Health Conditions</label>

<div class="checkbox-group">

<label>
<input type="checkbox" name="diabetes" <?= $row['suitable_for_diabetes'] ? "checked":"" ?>>
 Diabetes
</label>

<label>
<input type="checkbox" name="high_bp" <?= $row['suitable_for_high_bp'] ? "checked":"" ?>>
 High BP
</label>

<label>
<input type="checkbox" name="cholesterol" <?= $row['suitable_for_cholesterol'] ? "checked":"" ?>>
 Cholesterol
</label>

</div>

</div>

</div>

<button class="form-btn" name="update">Update Diet</button>

</form>

</div>

</div>

</body>
</html>