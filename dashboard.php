<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

/* --------------------------
LOGIN COUNT LOGIC (ADDED)
---------------------------*/
if(!isset($_SESSION['login_count'])){
    $_SESSION['login_count'] = 1;
} else {
    $_SESSION['login_count']++;
}

/* --------------------------
REVIEW SYSTEM (ADDED)
---------------------------*/
$checkReview = mysqli_query($conn,"
SELECT * FROM reviews WHERE user_id='$user_id'
");

$hasReview = mysqli_num_rows($checkReview) > 0;

if(isset($_POST['submit_review']) && !$hasReview){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    mysqli_query($conn,"
    INSERT INTO reviews(user_id,rating,comment)
    VALUES('$user_id','$rating','$comment')
    ");

    header("Location: dashboard.php");
    exit();
}

/* --------------------------
FETCH USER DATA
---------------------------*/
$userQuery = mysqli_query($conn, "SELECT bmi, bmi_category, goal FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($userQuery);

$bmi_category = $user['bmi_category'];
$goal = $user['goal'];

/* --------------------------
FETCH HEALTH PROFILE
---------------------------*/
$hpQuery = mysqli_query($conn, "SELECT * FROM health_profile WHERE user_id='$user_id'");
$health = mysqli_fetch_assoc($hpQuery);

/* --------------------------
RECOMMENDED DIET
---------------------------*/
$dietQuery = "SELECT * FROM diet_plans 
WHERE bmi_category='$bmi_category'
AND goal='$goal'";

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

$dietResult = mysqli_query($conn, $dietQuery);
$recommendedDiet = mysqli_fetch_assoc($dietResult);

/* --------------------------
RECOMMENDED EXERCISE
---------------------------*/
$exerciseQuery = "SELECT * FROM exercise_plans
WHERE bmi_category='$bmi_category'
AND goal='$goal'";

if ($health && $health['has_high_bp'] == 1) {
    $exerciseQuery .= " AND intensity_level!='High'";
}

$exerciseQuery .= " LIMIT 1";

$exerciseResult = mysqli_query($conn, $exerciseQuery);
$recommendedExercise = mysqli_fetch_assoc($exerciseResult);

/* --------------------------
START PLAN LOGIC
---------------------------*/
$plan_message = "";

if(isset($_POST['start_plan'])){

$check = mysqli_query($conn,"SELECT * FROM user_plan_history 
WHERE user_id='$user_id' AND status='active'");

if(mysqli_num_rows($check) > 0){

$plan_message = "⚠️ You already have an active plan!";

} else {

$diet_id = $recommendedDiet ? $recommendedDiet['id'] : NULL;
$exercise_id = $recommendedExercise ? $recommendedExercise['id'] : NULL;

mysqli_query($conn,"INSERT INTO user_plan_history
(user_id, diet_plan_id, exercise_plan_id, bmi_category, goal)
VALUES
('$user_id','$diet_id','$exercise_id','$bmi_category','$goal')");
    
$plan_message = "✅ Your plan has been started successfully!";
}
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Dashboard | BeWell</title>
<link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header class="dash-header">

<a href="index.php" class="logo">
    <img src="images/bewell_logo_4.png" alt="BeWell Logo">
    <span>BeWell</span>
</a>

<div class="profile-dropdown">
<span class="profile-name" onclick="toggleMenu()">
👤 <?= $name ?> ▼
</span>

<div id="dropdownMenu" class="dropdown-menu">
<a href="edit_profile.php">Edit Profile</a>
<a href="logout.php">Logout</a>
</div>
</div>

</header>


<h2 class="welcome">Welcome back, <?= $name ?> 🌿</h2>
<p class="subtitle">Your personalized wellness dashboard</p>

<div class="dashboard-container">

<!-- TOP ROW -->
<div class="top-row">

<div class="card">
<h3>📊 BMI</h3>
<p><?= $user['bmi'] ?> (<?= $user['bmi_category'] ?>)</p>
<a href="bmi.php" class="btn">Update BMI</a>
</div>

<div class="card">
<h3>🩺 Health Profile</h3>
<p>
BP: <?= ($health && $health['has_high_bp']) ? "Yes" : "No" ?><br>
Diabetes: <?= ($health && $health['has_diabetes']) ? "Yes" : "No" ?><br>
Cholesterol: <?= ($health && $health['has_cholesterol']) ? "Yes" : "No" ?>
</p>
<a href="health_profile.php" class="btn">Update</a>
</div>

<div class="card">
<h3>📈 Track Progress</h3>
<p>Monitor your weight & BMI improvements</p>
<a href="track_progress.php" class="btn">View Progress</a>
</div>

</div>

<!-- SECOND ROW -->
<div class="second-row">

<div class="card">
<h3>🥗 Recommended Diet</h3>

<?php if($recommendedDiet){ ?>
<p>
🥗 Balanced meals<br>
🍎 Fruits & vegetables<br>
🥜 Healthy snacks
</p>
<?php } else { ?>
<p>No plan available</p>
<?php } ?>

<a href="diet.php" class="btn">View Full Plan</a>
</div>

<div class="card">
<h3>🏋️ Recommended Exercise</h3>

<?php if($recommendedExercise){ ?>
<p>
🏃 Cardio workouts<br>
💪 Strength training<br>
🧘 Flexibility exercises
</p>
<?php } else { ?>
<p>No plan available</p>
<?php } ?>

<a href="exercise.php" class="btn">View Full Plan</a>
</div>

</div>

<!-- START PLAN -->
<div class="card start-plan">

<h3>🚀 Start Plan</h3>

<form method="POST">
<button class="btn" name="start_plan">Start</button>
</form>

<?php if(!empty($plan_message)){ ?>
<p style="margin-top:6px; font-size:13px;">
<?= $plan_message ?>
</p>
<?php } ?>

</div>


<!-- DIETICIANS -->
<div class="dietician-section">

<h2>👩‍⚕️ Popular Dieticians</h2>

<p>Consult certified experts for personalized guidance</p>

<a href="dieticians.php" class="btn">View Dieticians</a>

</div>

</div>

<!-- REVIEW SECTION -->
<div style="text-align:center; margin:20px 0;">
<?php if(!$hasReview){ ?>
    <button class="btn" onclick="openReview()">⭐ Give Review</button>
<?php } else { ?>
    <p style="color:green;">✔ You already submitted a review</p>
<?php } ?>
</div>

<!-- REVIEW POPUP -->
<div id="reviewPopup" class="popup">
    <div class="popup-content">

        <span class="close-btn" onclick="closeReview()">×</span>

        <h2>⭐ Give Your Review</h2>

        <form method="POST">

            <label>Rating</label>
            <select name="rating" required>
                <option value="">Select</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>

            <label>Comment</label>
            <textarea name="comment" rows="4" required></textarea>

            <button name="submit_review">Submit Review</button>
            <button type="button" onclick="askLater()">Ask Later</button>
        </form>

    </div>
</div>

<script>
function openReview(){
    document.getElementById("reviewPopup").style.display = "flex";
}

function closeReview(){
    document.getElementById("reviewPopup").style.display = "none";
}

function toggleMenu() {
var menu = document.getElementById("dropdownMenu");
menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

window.onclick = function(event) {
if (!event.target.closest('.profile-dropdown')) {
document.getElementById("dropdownMenu").style.display = "none";
}
}

function askLater(){
    document.getElementById("reviewPopup").style.display = "none";
}

/* AUTO POPUP AFTER 3 LOGINS */
window.onload = function(){
<?php if(!$hasReview && $_SESSION['login_count'] >= 3){ ?>
    document.getElementById("reviewPopup").style.display = "flex";
<?php } ?>
};
</script>

<?php include "chatbot.php"; ?>

</body>
</html>