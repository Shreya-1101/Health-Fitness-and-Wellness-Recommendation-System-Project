<?php
include "../db/config.php";

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM dieticians WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$name = $_POST['name'];
$specialization = $_POST['specialization'];
$experience = $_POST['experience'];
$contact = $_POST['contact'];
$website_link = $_POST['website_link'];

$image = $row['profile_image'];

if(!empty($_FILES['profile_image']['name'])){

$image = $_FILES['profile_image']['name'];
$tmp = $_FILES['profile_image']['tmp_name'];

move_uploaded_file($tmp,"../uploads/".$image);

}

mysqli_query($conn,"UPDATE dieticians SET
name='$name',
specialization='$specialization',
experience='$experience',
contact='$contact',
website_link='$website_link',
profile_image='$image'
WHERE id='$id'");

header("Location:view_dieticians.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Dietician</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

.form-card{
background:white;
padding:20px;
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

<h2 class="page-title">Edit Dietician</h2>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Name</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>">
</div>

<div class="form-group">
<label>Specialization</label>
<textarea name="specialization" rows="4"><?php echo $row['specialization']; ?></textarea>
</div>

<div class="form-group">
<label>Experience (years)</label>
<input type="number" name="experience" value="<?php echo $row['experience']; ?>" rows="2"></input>
</div>

<div class="form-group">
<label>Contact</label>
<input type="text" name="contact" value="<?php echo $row['contact']; ?>">
</div>

<div class="form-group">
<label>Website</label>
<input type="text" name="website_link" value="<?php echo $row['website_link']; ?>">
</div>

<div class="form-group">
<label>Profile Image</label>
<input type="file" name="profile_image">
<br><br>

<?php if(!empty($row['profile_image'])){ ?>

<img src="../uploads/<?php echo $row['profile_image']; ?>" width="80">

<?php } ?>

</div>


<button class="submit-btn" name="update">Update Dietician</button>

</form>

</div>

</div>

</body>
</html>