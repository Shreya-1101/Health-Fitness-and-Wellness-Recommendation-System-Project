<?php
include "db/config.php";

$result = mysqli_query($conn,"SELECT * FROM dieticians");
?>

<!DOCTYPE html>
<html>
<head>

<title>Popular Dieticians | BeWell</title>

<link rel="stylesheet" href="css/dietician.css">

</head>

<body>

<div class="container">

<h1 class="title">👩‍⚕️ Popular Dieticians</h1>

<p class="subtitle">
Consult certified experts for personalized nutrition guidance
</p>

<!-- GRID START -->
<div class="dietician-grid">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="dietician-card">

    <!-- IMAGE -->
    <div class="img-box">
        <img src="uploads/<?php echo $row['profile_image']; ?>" alt="Dietician">
    </div>

    <!-- NAME -->
    <h3><?php echo $row['name']; ?></h3>

    <!-- SPECIALIZATION -->
    <ul class="specialization">
<?php
$items = explode("\n", $row['specialization']);
foreach($items as $item){
    if(trim($item) != ""){
        echo "<li>$item</li>";
    }
}
?>
</ul>

    <!-- EXPERIENCE -->
    <p class="experience">
        ⭐ <?php echo $row['experience']; ?> yrs experience
    </p>

    <!-- CONTACT -->
    <p class="contact">
        📞 <?php echo $row['contact']; ?>
    </p>

    <!-- BUTTON -->
    <?php if(!empty($row['website_link'])){ ?>
        <a href="<?php echo $row['website_link']; ?>" target="_blank" class="visit-btn">
            Visit Website
        </a>
    <?php } ?>

</div>

<?php } ?>

</div>
<!-- GRID END -->

<!-- BACK BUTTON -->
<div class="action">
    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>
</div>

</div>

</body>
</html>