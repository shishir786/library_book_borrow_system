<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookborrow";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookId = $_POST["BookId"];
    $tittle = $_POST["Tittle"];
    $author = $_POST["Author"];
    $isbn = $_POST["ISBN"];
    $category = $_POST["Category"];
    $quantity = $_POST["Quantity"];

    $sql = "UPDATE booklist SET Tittle=?, Author=?, ISBN=?, Category=?, Quantity=? WHERE BookId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $tittle, $author, $isbn, $category, $quantity, $bookId);

    if ($stmt->execute()) {
        //echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();

    header("Location: index.php");
    exit();
}

$conn->close();
