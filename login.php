<?php
session_start();
include "db/config.php";

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password ❌";
        }
    } else {
        $error = "Email not registered ❌";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BeWell</title>

    <!-- Remix Icon For Eye Toggle -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Login CSS -->
    <link rel="stylesheet" href="css/login.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body>

<!-- Background shapes -->
<div class="shape1"></div>
<div class="shape2"></div>

<!-- NAVBAR -->
<header class="navbar">
<a href="index.php" class="logo">
    <img src="images/bewell_logo_4.png" alt="BeWell Logo">
    <span>BeWell</span>
</a>

    <nav class="nav-links">
        <a href="index.php" class="<?php echo ($activePage=='home')?'active':''; ?>">Home</a>
        <a href="index.php#about" class="<?php echo ($activePage=='about')?'active':''; ?>">About</a>
        <a href="register.php" class="<?php echo ($activePage=='register')?'active':''; ?>">Register</a>
        <a href="login.php" class="<?php echo ($activePage=='login')?'active':''; ?>">Login</a>
    </nav>
</header>


<!-- LOGIN CONTAINER -->
<div class="register-container">

    <div class="register-box">

        <h2 class="title">Welcome Back <span>🌿</span></h2>
        <p class="subtitle">Log in to continue your BeWell journey</p>

        <?php if ($error): ?>
            <div class="error-box"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">

            <!-- EMAIL -->
            <div class="input-box">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <!-- PASSWORD WITH EYE ICON -->
            <div class="input-box">
                <label>Password</label>

                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <i class="ri-eye-off-line toggle-password" id="togglePassword"></i>
                </div>
            </div>

            <button name="login" class="register-btn">Login</button>
        </form>

        <p class="login-link">
            New here? <a href="register.php">Create an account</a>
        </p>

        <p class="forgot-link">
            <a href="reset_password.php">Forgot password?</a>
        </p>

    </div>

</div>

<script>
const pass = document.getElementById("password");
const icon = document.getElementById("togglePassword");

icon.onclick = () => {
    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.replace("ri-eye-off-line", "ri-eye-line");
    } else {
        pass.type = "password";
        icon.classList.replace("ri-eye-line", "ri-eye-off-line");
    }
}
</script>

</body>
</html>
