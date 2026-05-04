<?php
$activePage = 'register';
include "db/config.php";
include "send_mail.php";

if (isset($_POST['register'])) {

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];
    $height   = $_POST['height'];
    $weight   = $_POST['weight'];
    $goal     = $_POST['goal'];

    // INSERT USER
    $query = "INSERT INTO users 
        (name, email, password, age, gender, height, weight, goal)
        VALUES 
        ('$name', '$email', '$password', '$age', '$gender', '$height', '$weight', '$goal')";

    if (mysqli_query($conn, $query)) {

        // EMAIL SUBJECT
        $subject = "Welcome to BeWell, $name!";

        // EMAIL BODY (Professional Template)
        $body = '
        <div style="font-family:Poppins,Arial,sans-serif;background:#f4f6f8;padding:20px;">
            
            <div style="max-width:600px;margin:auto;background:white;border-radius:10px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                
                <div style="background:#2E8B57;color:white;padding:20px;text-align:center;">
                    <h2>Welcome to BeWell 🌿</h2>
                </div>

                <div style="padding:25px;color:#333;">
                    <h3>Hi '.$name.',</h3>

                    <p>Your fitness profile has been created successfully! 🎉</p>

                    <p>You can now log in and start your wellness journey with:</p>

                    <ul>
                        <li>🍎 Personalized Diet Plan</li>
                        <li>🏋️ Exercise Plan</li>
                        <li>🩺 Health Profile Tracking</li>
                        <li>📈 Progress Monitoring</li>
                    </ul>

                    <p>Stay consistent and keep moving towards a healthier lifestyle.</p>

                    <div style="text-align:center;margin:25px 0;">
                        <a href="http://localhost/fitness_website/login.php" 
                           style="background:#2E8B57;color:white;padding:12px 25px;text-decoration:none;border-radius:6px;font-weight:500;">
                           Login to BeWell
                        </a>
                    </div>

                    <p>Have a healthy day! 🌿</p>

                    <p><strong>Team BeWell</strong></p>
                </div>

                <div style="background:#f1f1f1;padding:10px;text-align:center;font-size:12px;color:#777;">
                    © 2026 BeWell Fitness App
                </div>

            </div>

        </div>
        ';

        // SEND EMAIL
        sendMail($email, $subject, $body);

        // REDIRECT
        header("Location: login.php?success=1");
        exit;

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account | BeWell</title>

<link rel="stylesheet" href="css/register.css?v=1.4">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

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


<section class="register-wrapper">

<div class="register-card">

<h2>Join <span>BeWell</span></h2>

<p class="subtitle">
Tell us about yourself to personalize your wellness journey 🌿
</p>

<form method="POST">

<div class="grid">

<div class="input-box">
<label>Name</label>
<input type="text" name="name" placeholder="Full Name" required>
</div>

<div class="input-box">
<label>Email</label>
<input type="email" name="email" placeholder="email@example.com" required>
</div>

<div class="input-box">
<label>Password</label>

<div class="password-wrapper">
<input type="password" id="regPassword" name="password" placeholder="••••••••" required>

<img src="https://cdn-icons-png.flaticon.com/128/2767/2767146.png"
class="toggle-password" id="toggleRegPassword">
</div>

</div>

<div class="input-box">
<label>Age</label>
<input type="number" name="age" required>
</div>

<div class="input-box">
<label>Gender</label>

<select name="gender" required>
<option disabled selected>Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

</div>

<div class="input-box">
<label>Goal</label>

<select name="goal" required>
<option disabled selected>Your Goal</option>
<option>Weight Loss</option>
<option>Weight Gain</option>
<option>Stay Fit</option>
</select>

</div>

<div class="input-box">
<label>Height (cm)</label>
<input type="number" name="height" required>
</div>

<div class="input-box">
<label>Weight (kg)</label>
<input type="number" name="weight" required>
</div>

</div>

<button type="submit" name="register" class="reg-btn">
Create My Profile
</button>

</form>

<p class="switch">
Already a member? <a href="login.php">Login</a>
</p>

</div>

</section>


<script>

const pass = document.getElementById("regPassword");
const toggle = document.getElementById("toggleRegPassword");

let visible = false;

toggle.addEventListener("click", () => {

visible = !visible;

pass.type = visible ? "text" : "password";

toggle.src = visible
? "https://cdn-icons-png.flaticon.com/128/2767/2767141.png"
: "https://cdn-icons-png.flaticon.com/128/2767/2767146.png";

});

</script>

</body>
</html>