<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <p> Have an account? <a href="loginpage.php">login</a> | Want to sign up? <a href="registrationpage.php">register</a> </p>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="homepage.php" class="logo">Within The Covers</a>

            <nav class="navbar">
                <a href="homepage.php">home</a>
                <a href="aboutpage.php">about</a>
                <a href="shoppage.php">shop</a>
                <a href="contactpage.php">contact</a>

            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="searchpage.php" class="fas fa-search"></a>
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="cartpage.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
            </div>

            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logoutpage.php" class="delete-btn">logout</a>
            </div>
        </div>
    </div>

</header>