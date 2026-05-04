<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = false;

/* FETCH EXISTING PROFILE */
$check = mysqli_query($conn, "SELECT * FROM health_profile WHERE user_id='$user_id'");
$profile = mysqli_fetch_assoc($check);

/* PROCESS FORM */
if (isset($_POST['save'])) {

    $bp          = isset($_POST['bp']) ? 1 : 0;
    $diabetes    = isset($_POST['diabetes']) ? 1 : 0;
    $cholesterol = isset($_POST['cholesterol']) ? 1 : 0;
    $other       = mysqli_real_escape_string($conn, $_POST['other']);

    if ($profile) {

        mysqli_query($conn,"UPDATE health_profile SET
        has_high_bp='$bp',
        has_diabetes='$diabetes',
        has_cholesterol='$cholesterol',
        other_conditions='$other'
        WHERE user_id='$user_id'");

    } else {

        mysqli_query($conn,"INSERT INTO health_profile
        (user_id,has_high_bp,has_diabetes,has_cholesterol,other_conditions)
        VALUES('$user_id','$bp','$diabetes','$cholesterol','$other')");
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Health Profile | BeWell</title>

<link rel="stylesheet" href="css/plan.css">

<style>

/* Compact Card */

.health-card{
background:white;
padding:20px 25px;
border-radius:18px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
border-left:6px solid #2d6a4f;
max-width:650px;
margin:auto;
}

/* Checkbox Layout */

.checkbox-row{
display:flex;
flex-direction:column;
gap:12px;
margin-top:10px;
}

.check-item{
display:flex;
align-items:center;
gap:10px;
font-size:17px;
}

/* Textarea */

.other-box{
width:100%;
height:70px;
padding:10px;
border-radius:10px;
border:2px solid #d7e5dc;
font-size:15px;
resize:none;
outline:none;
margin-top:8px;
}

/* Button */

.save-btn{
background:#275E44;
color:white;
padding:10px 22px;
font-size:16px;
border-radius:10px;
border:none;
cursor:pointer;
margin-top:15px;
}

.save-btn:hover{
background:#1f4b36;
}

/* Popup */

.popup{
position:fixed;
top:-120px;
left:50%;
transform:translateX(-50%);
background:#2ecc71;
color:white;
padding:12px 25px;
border-radius:10px;
font-size:18px;
transition:0.5s;
box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.popup.show{
top:30px;
}

</style>

</head>

<body>

<?php if ($success): ?>

<div class="popup show">✔ Profile Updated!</div>

<script>
setTimeout(()=>{
document.querySelector(".popup").classList.remove("show");
},2500);
</script>

<?php endif; ?>


<div class="container">

<h1>🩺 Health Profile</h1>

<p class="subtitle">Update your medical information</p>


<form method="POST">

<div class="health-card">

<h3>Health Conditions</h3>

<div class="checkbox-row">

<label class="check-item">
<input type="checkbox" name="bp"
<?php if ($profile && $profile['has_high_bp']) echo "checked"; ?>>
High Blood Pressure
</label>

<label class="check-item">
<input type="checkbox" name="diabetes"
<?php if ($profile && $profile['has_diabetes']) echo "checked"; ?>>
Diabetes
</label>

<label class="check-item">
<input type="checkbox" name="cholesterol"
<?php if ($profile && $profile['has_cholesterol']) echo "checked"; ?>>
High Cholesterol
</label>

</div>


<h3 style="margin-top:18px;">Other Medical Conditions</h3>

<textarea name="other" class="other-box"
placeholder="Write any additional conditions here..."><?= $profile ? $profile['other_conditions'] : "" ?></textarea>


<button type="submit" name="save" class="save-btn">
Save Profile
</button>


</div>

</form>


<br>

<a href="dashboard.php" class="back">
← Back to Dashboard
</a>

</div>

</body>
</html>