<?php
include "db/config.php";

$reviews = mysqli_query($conn,"
SELECT reviews.*, users.name 
FROM reviews 
JOIN users ON reviews.user_id = users.id
ORDER BY created_at DESC 
LIMIT 4
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BeWell | Wellness & Fitness</title>

<link rel="stylesheet" href="css/styles.css">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
<a href="#about">About</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
</nav>
</header>

<!-- HERO -->
<section class="hero">
<div class="hero-left">
<h1>Feel Better. <br> Live Healthier.</h1>

<p>
Transform Your Wellness Journey with BeWell.
Discover a smarter way to take charge of your fitness, nutrition, and daily habits.
BeWell helps you stay consistent with personalized guidance and progress tracking.
</p>

<div class="hero-buttons">
<a href="register.php" class="start-btn">Get Started</a>
<a href="#about" class="learn-btn">Learn More</a>
</div>
</div>

<div class="hero-right">
<img src="images/image.png" alt="Wellness">
</div>
</section>

<!-- ABOUT -->
<section id="about" class="about-section">
<div class="about-card">
<h2>About BeWell</h2>

<p>
BeWell is your all-in-one wellness companion designed to help you achieve a healthier and more balanced lifestyle. It provides personalized guidance by tracking your daily activities such as fitness, nutrition, hydration, and overall health progress. Whether your goal is weight loss, weight gain, or simply staying fit, BeWell adapts to your needs and supports you at every step of your journey. With easy-to-use tools, insightful progress tracking, and consistent motivation, BeWell empowers you to build sustainable habits and make smarter lifestyle choices for long-term well-being.
</p>

</div>
</section>

<!-- FEATURES -->
<section class="features">
<h2 class="section-title">What We Offer</h2>

<div class="feature-grid">

<div class="feature-card">
<span class="icon">💪</span>
<h3>Fitness Plans</h3>
<p>Personalized workouts based on your goals.</p>
</div>

<div class="feature-card">
<span class="icon">🥗</span>
<h3>Diet Plans</h3>
<p>Smart meals tailored to your health.</p>
</div>

<div class="feature-card">
<span class="icon">📊</span>
<h3>BMI Tracking</h3>
<p>Track your health progress easily.</p>
</div>

<div class="feature-card">
<span class="icon">👨‍⚕️</span>
<h3>Dieticians</h3>
<p>Consult expert dieticians.</p>
</div>

</div>
</section>

<!-- REVIEWS -->
<section class="reviews-section">

<h2 class="section-title">⭐ What Our Users Say</h2>

<div class="reviews-container">

<?php while($row = mysqli_fetch_assoc($reviews)){ ?>

<div class="review-card">

    <div class="review-header">
        <span class="user-icon">👤</span>
        <span class="review-name"><?php echo $row['name']; ?></span>
    </div>

    <div class="review-stars">
        <?php
        for($i=1; $i<=5; $i++){
            echo ($i <= $row['rating']) ? "⭐" : "☆";
        }
        ?>
    </div>

    <p class="review-text">
        "<?php echo $row['comment']; ?>"
    </p>

</div>

<?php } ?>

</div>

</section>

<!-- FAQ -->
<section class="faq-section">
<h2 class="section-title">Frequently Asked Questions</h2>

<div class="faq-container">

<div class="faq-item">
<button class="faq-question">What is BeWell? <span>+</span></button>
<div class="faq-answer">
<p>BeWell helps track fitness, diet, and wellness.</p>
</div>
</div>

<div class="faq-item">
<button class="faq-question">Are plans personalized? <span>+</span></button>
<div class="faq-answer">
<p>Yes, based on your goals and health data.</p>
</div>
</div>

<div class="faq-item">
<button class="faq-question">Do I need equipment? <span>+</span></button>
<div class="faq-answer">
<p>No, workouts are home-friendly.</p>
</div>
</div>

<div class="faq-item">
<button class="faq-question">Can I track progress? <span>+</span></button>
<div class="faq-answer">
<p>Yes, BeWell provides detailed progress tracking tools.</p>
</div>
</div>

</div>
</section>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 BeWell • Designed with 💚</p>
</footer>
<?php include "chatbot.php"; ?>


</body>
</html>