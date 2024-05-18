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
    <!--Font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/adminpagestyle.css" />

    <div class="flex">

        <a href="adminpage.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="adminpage.php">home</a>
            <a href="adminproducts.php">products</a>
            <a href="adminorders.php">orders</a>
            <a href="adminusers.php">users</a>
            <a href="admincontacts.php">messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p>username :<span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email :<span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logoutpage.php" class="delete-btn">logout</a>
            <div>
                <p> switch profile? <a href="loginpage.php">login</a> | <a href="registrationpage.php">register</a></p>
            </div>
        </div>
    </div>

</header>