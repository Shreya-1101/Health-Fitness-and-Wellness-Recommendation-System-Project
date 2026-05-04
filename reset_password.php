<?php
include "db/config.php";

$message = "";
$message_class = "";

if (isset($_POST['reset'])) {

    $email = $_POST['email'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // password match check
    if ($new_pass !== $confirm_pass) {
        $message = "Passwords do not match!";
        $message_class = "error";
    } else {
        
        // check email exists
        $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($q) == 1) {

            $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

            mysqli_query($conn, "UPDATE users SET password='$hashed' WHERE email='$email'");

            $message = "Password updated successfully! ✔";
            $message_class = "success";

        } else {
            $message = "Email not found!";
            $message_class = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | BeWell</title>
    <link rel="stylesheet" href="css/login.css?v=1.3">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="glass-nav">
        <div class="logo">BeWell</div>
        <div class="nav-links">
            <div class="auth-buttons">
                <a href="register.php" class="btn btn-glow">Register</a>
                <a href="login.php" class="btn btn-glow">Login</a>
            </div>
        </div>
    </nav>

    <div class="auth-card">
        <h2 class="auth-title">Reset Password</h2>
        <p class="auth-subtitle">Enter your new password to secure your account</p>

        <?php if ($message): ?>
            <div class="<?= $message_class ?>-banner"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label>Registered Email</label>
                <input type="email" name="email" placeholder="name@example.com" required>
            </div>

            <div class="input-group">
                <label>New Password</label>
                <div class="password-wrapper">
                    <input type="password" id="newPass" name="new_password" placeholder="••••••••" required>
                    <i class="ri-eye-off-line toggle-password" data-target="newPass"></i>
                </div>
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" id="confirmPass" name="confirm_password" placeholder="••••••••" required>
                    <i class="ri-eye-off-line toggle-password" data-target="confirmPass"></i>
                </div>
            </div>

            <button type="submit" name="reset" class="auth-btn">Update Password</button>
        </form>

        <div class="auth-link">
            <a href="login.php">← Back to Login</a>
        </div>
    </div>

<script>
document.querySelectorAll(".toggle-password").forEach(icon => {
    icon.addEventListener("click", () => {
        const input = document.getElementById(icon.dataset.target);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("ri-eye-off-line", "ri-eye-line");
        } else {
            input.type = "password";
            icon.classList.replace("ri-eye-line", "ri-eye-off-line");
        }
    });
});
</script>

</body>
</html>

