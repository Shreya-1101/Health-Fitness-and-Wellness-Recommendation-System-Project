<?php
session_start();
include "../db/config.php";

/* FETCH DATA */
$result = mysqli_query($conn, "
SELECT * FROM user_plan_history
ORDER BY started_at ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Plan History | Admin</title>

<link rel="stylesheet" href="admin_css/admin.css">

<style>

/body{
    font-family:'Segoe UI', sans-serif;
    background:#f4f7f5;
    margin:0;
}

/* Container */
.container{
    margin-left:220px;
    padding:30px;
}

/* Title */
h2{
    color:#1b4332;
    margin-bottom:15px;
}

/* ===== SEARCH BAR ===== */
.search-box{
    margin-bottom:15px;
}

.search-box input{
    width:100%;
    padding:10px;
    border-radius:6px;
    border:2px solid #d7e5dc;
    outline:none;
}

/* ===== TABLE ===== */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

/* HEADER (LIKE YOUR 2ND IMAGE) */
th{
    background:#2e8b57;   /* ✅ SAME GREEN */
    color:white;
    padding:12px;
    text-align:center;
    font-weight:600;
}

/* DATA */
td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

/* ROW STYLE */
tr:nth-child(even){
    background:#f9f9f9;
}

tr:hover{
    background:#f1f1f1;
}

/* STATUS */
.status{
    padding:5px 12px;
    border-radius:20px;
    font-size:13px;
}

.active{
    background:#d8f3dc;
    color:#1b4332;
}

/* BUTTON */
.back{
    display:inline-block;
    margin-top:20px;
    background:#2e8b57;
    color:white;
    padding:8px 18px;
    border-radius:6px;
    text-decoration:none;
}

.back:hover{
    background:#256f47;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<h2>BeWell Admin</h2>

<a href="admin_dashboard.php">Dashboard</a>
<a href="view_diet.php">Manage Diet Plans</a>
<a href="view_exercise.php">Manage Exercise Plans</a>
<a href="view_videos.php">Manage Exercise Videos</a>
<a href="view_dieticians.php">Manage Dieticians</a>
<a href="plan_history.php">User Plan History</a>
<a href="users.php">Users</a>
<a href="../logout.php">Logout</a>
</div>


<!-- MAIN -->
<div class="container">

<h2>📊 User Plan History</h2>

<!-- SEARCH -->
<div class="search-box">
<input type="text" id="search" placeholder="Search by goal or status...">
</div>

<div class="table-card">

<table id="myTable">

<tr>
<th>ID</th>
<th>User ID</th>
<th>Diet Plan ID</th>
<th>Exercise Plan ID</th>
<th>Goal</th>
<th>BMI</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['user_id'] ?></td>
<td><?= $row['diet_plan_id'] ?></td>
<td><?= $row['exercise_plan_id'] ?></td>
<td><?= $row['goal'] ?></td>
<td><?= $row['bmi_category'] ?></td>
<td>
<span class="status active"><?= $row['status'] ?></span>
</td>
<td><?= $row['started_at'] ?></td>
</tr>

<?php } ?>

</table>

</div>

<a href="admin_dashboard.php" class="back">← Back</a>

</div>

<!-- SEARCH SCRIPT -->
<script>
document.getElementById("search").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#myTable tr");

    rows.forEach((row, index) => {
        if(index === 0) return; // skip header
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? "" : "none";
    });
});
</script>

</body>
</html>