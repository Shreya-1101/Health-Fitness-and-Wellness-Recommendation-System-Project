<?php
session_start();

// IF ADMIN IS ALREADY LOGGED IN → SEND TO DASHBOARD
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}

include "../db/config.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"
    SELECT * FROM admin
    WHERE email='$email' AND password='$password'
    ");

    if(mysqli_num_rows($query) > 0){

        $_SESSION['admin_logged_in'] = true;

        header("Location: admin_dashboard.php");
        exit();

    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body { font-family: Arial; background:#e8fff0; text-align:center; padding-top:120px; }
form { background:white; padding:30px; border-radius:10px; width:300px; margin:auto; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input { width:90%; padding:10px; margin:10px; border-radius:5px; border:1px solid #ccc; }
button { background:#2d6a4f; color:white; padding:10px 20px; border:none; border-radius:6px; cursor:pointer; }
button:hover { background:#1b4332; }
.error { color:red; }
</style>
</head>

<body>

<h2>Admin Login</h2>

<form method="POST">
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <input type="text" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>
    
    <button type="submit" name="login">Login</button>
</form>

</body>
</html>