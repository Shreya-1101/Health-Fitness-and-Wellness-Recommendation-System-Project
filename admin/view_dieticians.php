<?php
include "../db/config.php";

$result = mysqli_query($conn,"SELECT * FROM dieticians");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dieticians</title>
<link rel="stylesheet" href="admin_css/admin.css">


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

<h2 class="page-title">Dieticians</h2>

<a class="add-btn" href="add_dietician.php">+ Add Dietician</a>

<table class="data-table diet-table">

<tr>
<th>ID</th>
<th>Name</th>
<th>Specialization</th>
<th>Experience</th>
<th>Contact</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td class="spec-col">
<ul>
<?php 
$specs = explode("\n", $row['specialization']);
foreach($specs as $s){
    echo "<li>" . trim($s) . "</li>";
}
?>
</ul>
</td>
<td><?php echo $row['experience']; ?> yrs</td>
<td class="contact-col">
<?php echo nl2br($row['contact']); ?>
</td>

<td>
<img src="../uploads/<?php echo $row['profile_image']; ?>" width="80">
</td>

<td class="actions">

<a class="edit-btn" href="edit_dietician.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="delete-btn"
href="delete_dietician.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this dietician?')">Delete</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>