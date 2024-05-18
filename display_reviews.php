<?php
include 'configuration.php';

$sql = "SELECT * FROM review";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<br>" .  "Reviewer: " . $row["name"] . "<br>Rating: " . $row["rating"] . "<br>Review: " . $row["content"] . "<br>Book Name: " . $row["book_name"] . "<br><br>";
    }
} else {
    echo "No reviews yet.";
}

$conn->close();
?>

<link rel="stylesheet" href="css/reviews.css" />