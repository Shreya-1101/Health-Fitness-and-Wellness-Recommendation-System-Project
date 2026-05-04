<?php
include "../db/config.php";

$result = mysqli_query($conn,"SELECT * FROM exercise_videos");
?>

<!DOCTYPE html>
<html>

<head>

<title>Exercise Videos</title>

<link rel="stylesheet" href="admin_css/admin.css">

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


<!-- Main Content -->
<div class="main">

<h2 class="page-title">Exercise Videos</h2>

<a class="add-btn" href="add_video.php">+ Add Video</a>

<table class="data-table">

<tr>
<th>ID</th>
<th>Title</th>
<th>Video URL</th>
<th>Category</th>
<th>Difficulty</th>
<th>Goal</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>
<a href="<?php echo $row['video_url']; ?>" target="_blank">
Watch Video
</a>
</td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['difficulty_level']; ?></td>

<td><?php echo $row['goal']; ?></td>

<td>

<a class="edit-btn" href="edit_video.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="delete-btn" href="delete_video.php?id=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>