<?php
session_start();
include "db/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile | BeWell</title>
    <link rel="stylesheet" href="css/edit_profile.css?v=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
<a href="index.php" class="logo">
    <img src="images/bewell_logo_4.png" alt="BeWell Logo">
    <span>BeWell</span>
</a>

    <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="edit_profile.php" class="active">Profile</a>
        <a href="logout.php" class="logout">Logout</a>
    </nav>
</header>

<div class="edit-wrapper">

    <div class="edit-card">
        <h2>Edit Your Profile</h2>
        <p class="subtitle">Update your personal details 📝</p>

        <form action="update_profile.php" method="POST">

            <div class="grid">

                <div class="input-box">
                    <label>Name</label>
                    <input type="text" name="name" value="<?= $user['name'] ?>" required>
                </div>

                <div class="input-box">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>" required>
                </div>

                <div class="input-box">
                    <label>Age</label>
                    <input type="number" name="age" value="<?= $user['age'] ?>" required>
                </div>

                <div class="input-box">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="<?= $user['gender'] ?>" selected><?= $user['gender'] ?></option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <div class="input-box">
                    <label>Height (cm)</label>
                    <input type="number" name="height" value="<?= $user['height'] ?>" required>
                </div>

                <div class="input-box">
                    <label>Weight (kg)</label>
                    <input type="number" name="weight" value="<?= $user['weight'] ?>" required>
                </div>

                <div class="input-box">
                    <label>Goal</label>
                    <select name="goal" required>
                        <option value="<?= $user['goal'] ?>" selected><?= $user['goal'] ?></option>
                        <option>Weight Loss</option>
                        <option>Weight Gain</option>
                        <option>Stay Fit</option>
                    </select>
                </div>

            </div>

            <button class="save-btn">Save Changes</button>

        </form>

    </div>

</div>

</body>
</html>
