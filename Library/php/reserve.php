<?php
session_start();
require_once "database.php";
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
} else {

    $username = $_SESSION['Username'];

    $isbn = $conn->real_escape_string($_GET['ISBN']);

    // checks if the book is already reserved
    $checkReserved = "SELECT * FROM reservations WHERE ISBN='$isbn'";
    $result_reservations = $conn->query($checkReserved);

    if ($result_reservations->num_rows > 0) { // unreserve the book
        $sql_books = "UPDATE books SET Reserved='N' WHERE ISBN='$isbn'";
        $sql_reservations = "DELETE FROM reservations WHERE ISBN='$isbn'";
        $conn->query($sql_books);
        $conn->query($sql_reservations);
        header("location: view_reserved.php");
        exit();
    } else { // reserve the book
        $date = date('Y-m-d');
        $sql_books = "UPDATE books SET Reserved='Y' WHERE ISBN='$isbn'";
        $sql_reservations = "INSERT INTO reservations VALUES ('$isbn', '$username', '$date')";
        $conn->query($sql_books);
        $conn->query($sql_reservations);
        header("location: search.php");
        exit();
    }
}
