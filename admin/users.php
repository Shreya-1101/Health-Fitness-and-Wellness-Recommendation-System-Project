<?php
include "../db/config.php";

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>

<title>Registered Users</title>

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

<h2 class="page-title">Registered Users</h2>

<table class="data-table">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Age</th>
<th>Gender</th>
<th>Height</th>
<th>Weight</th>
<th>Goal</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['height']; ?></td>
<td><?php echo $row['weight']; ?></td>
<td><?php echo $row['goal']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>