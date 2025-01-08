<?php


// from for add book information

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data into variables
    $Title = $_POST['booksssTitle'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];


    $server = "localhost";
    $username = "root";
    $password = "";

    // database connection started
    $con = mysqli_connect($server, $username, $password);


    if (!$con) {
        die("Could not connect to" . mysqli_connect_error());
    }

    // Here, you can save the data to a database or perform further processing


    $sql = "INSERT INTO `bookborrow`.`booklist` (`Tittle`, `Author`, `ISBN`, `Category`, `Quantity`) VALUES ('$Title', '$author', '$isbn', '$category', '$quantity');";
    if ($con->query($sql) == true) {
        //echo "Successfully incerted";
    } else {
        echo "Error $sql <br> $con->error";
    }

    // database connection turned off
    $con->close();



    header("Location: index.php");
    exit();
} else {
    echo "Invalid request method.";
}
