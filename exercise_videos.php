<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

/* GET USER GOAL */

$userQuery = mysqli_query($conn,"SELECT goal FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($userQuery);

$goal = $user['goal'];

/* GET VIDEOS BASED ON GOAL */

$videos = mysqli_query($conn,
"SELECT * FROM exercise_videos WHERE goal='$goal'");
?>

<!DOCTYPE html>
<html>

<head>

<title>Exercise Videos | BeWell</title>

<link rel="stylesheet" href="css/plan.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>

/* Page spacing */

.video-container{
max-width:1000px;
margin:auto;
}

/* Video grid */

.video-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-top:25px;
}

/* Video cards */

.video-card{
background:white;
padding:18px;
border-radius:18px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
text-align:center;
transition:0.3s;
border-left:5px solid #2d6a4f;
}

.video-card:hover{
transform:translateY(-6px);
box-shadow:0 15px 30px rgba(0,0,0,0.15);
}

/* iframe size */

.video-card iframe{
width:100%;
height:170px;
border-radius:12px;
margin-bottom:12px;
}

/* title */

.video-card h3{
color:#275E44;
margin-bottom:10px;
font-size:20px;
}

/* category text */

.video-card p{
font-size:15px;
margin:4px 0;
}

/* back button */

.back{
display:inline-block;
margin-top:35px;
padding:12px 25px;
background:#275E44;
color:white;
border-radius:25px;
text-decoration:none;
font-weight:600;
}

.back:hover{
background:#1e4c37;
}

</style>

</head>

<body>

<div class="container video-container">

<h1 class="title">Recommended Exercise Videos 🎥</h1>

<p class="subtitle">
Based on your goal: <strong><?php echo $goal; ?></strong>
</p>

<div class="video-grid">

<?php while($row = mysqli_fetch_assoc($videos)) { ?>

<div class="video-card">

<iframe 
src="<?php echo $row['video_url']; ?>" 
frameborder="0" 
allowfullscreen>
</iframe>

<h3><?php echo $row['title']; ?></h3>

<p><strong>Category:</strong> <?php echo $row['category']; ?></p>

<p><strong>Level:</strong> <?php echo $row['difficulty_level']; ?></p>

</div>

<?php } ?>

</div>

<div style="text-align:center">

<a href="exercise.php" class="back">
← Back to Exercise Plan
</a>

</div>

</div>

</body>
</html>