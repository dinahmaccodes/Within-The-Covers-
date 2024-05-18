<?php

include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:loginpage.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!--Font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!--Custom css file link-->
    <link rel="stylesheet" href="css/registrationstyle.css" />

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>about us</h3>
        <p> <a href="homepage.php">home</a> / about </p>
    </div>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Welcome to Within the Covers, your very own online book club to connect with fellow bookworms and delve into the magic of literature!
                <p>Our aim is to build an online community full of readers sharing their honest opinions.
                </p>
                <p>We're a passionate community of readers from all walks of life, united by our love of getting lost within the covers of a good book.
                    <br> If you still have questions, don't be shy to reach out to us
                </p>
                <a href="contactpage.php" class="btn">contact us</a>
            </div>

        </div>

    </section>

    <section class="reviews">

        <h1 class="title">Our client's reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/pic-1.jpg" alt="">
                <p>Joining Within the Covers has been a game-changer for my reading life!
                    <br>I used to struggle to finish books on my own, but the discussions and shared enthusiasm really motivate me.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Madeline J.</h3>
            </div>

            <div class="box">
                <img src="images/pic-2.jpg" alt="">
                <p>I love the convenience of this online book club.
                    <br>I can participate in the discussions at my own pace, in between work and family commitments.
                    <br>It's a great way to explore new genres and rediscover the joy of discussing books with others.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>David 0.</h3>
            </div>

            <div class="box">
                <img src="images/pic-3.jpg" alt="">
                <p>It's a wonderful community of friendly and passionate readers. The online format allows me to connect with people who share my love of literature, even though we're miles apart.
                    <br>Highly recommend!
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Evangeline</h3>
            </div>

            <div class="box">
                <img src="images/pic-4.jpg" alt="">
                <p>As someone who's always loved reading but felt a bit shy about book clubs, Within the Covers has been perfect.
                    <br>I can participate as much or as little as I'm comfortable with, and the online format feels safe and inclusive.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Ruth</h3>
            </div>

            <div class="box">
                <img src="images/pic-5.jpg" alt="">
                <p>Working full-time as a doctor leaves me with precious little free time for hobbies. That's why Within the Covers is such a lifesaver!
                    I can participate in the discussions at any time, even during a quick lunch break. The online format allows for a diverse range of voices and perspectives too.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Johnathan</h3>
            </div>

            <div class="box">
                <img src="images/pic-6.png" alt="">
                <p>As a lifelong introvert, the idea of joining a traditional book club always felt intimidating. [Club Name]'s online format provided the perfect solution! I can participate in the discussions at my own pace, without feeling pressured to speak up in a larger group.

                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Chisom</h3>
            </div>

        </div>

    </section>

    <section class="authors">

        <h1 class="title">our popular authors</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/author-1.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Holly Black</h3>
            </div>

            <div class="box">
                <img src="images/author-2.jpeg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Chimamanda Ngozi Adichie</h3>
            </div>

            <div class="box">
                <img src="images/author-3.jpeg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>James Clear</h3>
            </div>

            <div class="box">
                <img src="images/author-4.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Bola Sokunobi</h3>
            </div>

            <div class="box">
                <img src="images/author-5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Robert Kiyosaki</h3>
            </div>

            <div class="box">
                <img src="images/author-6.webp" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Adalyn Grace</h3>
            </div>

        </div>

    </section>







    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/homescript.js"></script>

</body>

</html>