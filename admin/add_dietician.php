<?php
include "../db/config.php";

if(isset($_POST['add'])){

$name=$_POST['name'];
$specialization=$_POST['specialization'];
$experience=$_POST['experience'];
$contact=$_POST['contact'];
$website=$_POST['website'];

$image=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"../uploads/".$image);

$query="INSERT INTO dieticians
(name,specialization,experience,Contact,website_link,profile_image)
VALUES
('$name','$specialization','$experience','$contact','$website','$image')";

mysqli_query($conn,$query);

header("Location:view_dieticians.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Dietician</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

.form-card{
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
width:90%;   /* increase width */
max-width:1000px;
}

.main{
padding:20px;
display:flex;
flex-direction:column;
align-items:center;
}
.main h2{
font-size:30px;
}


.page-title{
text-align:center;
width:100%;
}

/* INPUT STYLE */
.form-group{
margin-bottom:18px;
}

.form-group label{
display:block;
margin-bottom:6px;
font-weight:600;
font-size:18px;
}

.form-group input,
.form-group textarea{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:6px;
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


<div class="main">

<h2 class="page-title">Add Dietician</h2>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Name</label>
<input type="text" name="name" required>
</div>


<div class="form-group">
<label>Specialization</label>
<textarea name="specialization" rows="4"></textarea>
</div>

<div class="form-group">
<label>Experience (years)</label>
<textarea name="experience" rows="2"></textarea>
</div>

<div class="form-group">
<label>Contact</label>
<textarea name="contact" rows="2"></textarea>
</div>

<div class="form-group">
<label>Website</label>
<input type="text" name="website">
</div>

<div class="form-group">
<label>Profile Image</label>
<input type="file" name="image">
</div>


<button class="submit-btn" name="add">Add Dietician</button>

</form>

</div>

</div>

</body>
</html>