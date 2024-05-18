<?php
include 'configuration.php';


if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $rating = $_POST['rating'];
    $book_name = $_POST['book name'];


    $sql =  "INSERT INTO `review` (`id`, `page_id`, `name`, `content`, `book_name`, `rating`, `submit_date`) VALUES (NULL, '$name', '$content', '$book_name', '$rating', '', current_timestamp())";

    if ($conn->query($sql) == TRUE) {

        echo "Review submitted successfully!";
    } else {
        echo "Error: ", $sql, "<br>", $conn->error;
    }
    $conn->close();
}

?>

<link rel="stylesheet" href="css/reviews.css" />