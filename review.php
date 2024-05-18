<?php

include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:loginpage.php');
}

?>
<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review form</title>

</head>

<body>
    <div class="heading">
        <h3>reviews</h3>
        <p> <a href="homepage.php">home</a> / review </p>

    </div>
    <section class="reviews">
        <form>
            <div class="review">
                <h2> Check out other reviews & <br> Drop yours as well<h2>

                    </h2>
                    <?php include 'display_reviews.php'; ?>
                    </h3>
        </form>
        </div>
    </section>
    <div>



        <section class="about_review">
            <h2>Submit your Review! </h2>
            <p>Join the others</p>
            <form action="submit_review.php" method="post">
                <label for="name">Your Name:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="content" name="content" required></textarea><br>
                    <textarea id="content" name="content" required></textarea><br>

                    <label for="rating">Rating(1-5):</label><br>
                    <input type="number" id="rating" name="rating" min="1" max="5" required><br>
                    <input type="submit" value="Submit review">


            </form>
    </div>


    <!--Font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!--Custom css file link-->
    <link rel="stylesheet" href="css/registrationstyle.css" />
    <link rel="stylesheet" href="css/reviews.css" />


</body>

</html>


<?php include 'footer.php'; ?>