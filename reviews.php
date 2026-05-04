<?php
session_start();
include "db/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* SAVE REVIEW */
if(isset($_POST['submit_review'])){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    mysqli_query($conn,"
    INSERT INTO reviews(user_id,rating,comment)
    VALUES('$user_id','$rating','$comment')
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Give Review</title>

<style>
.container{
width:60%;
margin:auto;
padding:20px;
}

.review-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

textarea, select{
width:100%;
padding:10px;
margin-top:10px;
border-radius:6px;
}

button{
background:#2e8b57;
color:white;
padding:10px;
border:none;
border-radius:6px;
margin-top:10px;
}
</style>

</head>

<body>

<div class="container">

<h2>⭐ Give Your Review</h2>

<form method="POST" class="review-box">

<label>Rating</label>
<select name="rating" required>
<option value="">Select</option>
<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>
</select>

<label>Comment</label>
<textarea name="comment" rows="4" required></textarea>

<button name="submit_review">Submit Review</button>

</form>

</div>

</body>
</html>