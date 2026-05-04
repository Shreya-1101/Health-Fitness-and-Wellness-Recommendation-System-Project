<?php
include "../db/config.php";

$result = mysqli_query($conn,"SELECT * FROM exercise_plans");
?>

<!DOCTYPE html>
<html>
<head>

<title>Exercise Plans</title>

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

<h2 class="page-title">Exercise Plans</h2>

<a class="add-btn" href="add_exercise.php">+ Add Exercise Plan</a>

<table class="data-table">

<tr>
<th>ID</th>
<th>BMI</th>
<th>Goal</th>
<th>Exercises</th>
<th>Duration</th>
<th>Intensity</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['bmi_category']; ?></td>
<td><?php echo $row['goal']; ?></td>
<td><?php echo $row['exercises']; ?></td>
<td><?php echo $row['duration']; ?></td>
<td><?php echo $row['intensity_level']; ?></td>

<td class="actions">

<a class="edit-btn" href="edit_exercise.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="delete-btn" href="delete_exercise.php?id=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>