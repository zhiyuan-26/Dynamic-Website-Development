<?php
session_start();
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/table_style.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['Username'])) {
        header("Location: index.php");
        exit();
    } else {
    ?>
        <div class="navbar navbar-expand-lg sticky-top user-select-none">
            <a href="search.php">Search</a>
            <a class="active-page" href="#">Reserve</a>
            <a class="logout" href="logout.php">Logout</a>
        </div>

        <div class="body">
            <h1 class="content-heading">Books reserved</h1>
            <?php
            $username = $_SESSION['Username'];

            $sql = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDescription FROM books b 
            JOIN reservations r USING(ISBN) 
            JOIN category c USING(CategoryID)
            WHERE r.Username='$username'";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                //output data of each row in a table
                echo "<table>";
                echo ("<th>Title</th>");
                echo ("<th>Author</th>");
                echo ("<th>Edition</th>");
                echo ("<th>Year</th>");
                echo ("<th>Category</th>");
                echo ("<th>Manage Reservation</th>");

                while ($row = $result->fetch_assoc()) {
                    echo ("<tr><td>");
                    echo (htmlentities($row["BookTitle"]));
                    echo ("</td><td>");
                    echo (htmlentities($row["Author"]));
                    echo ("</td><td>");
                    echo (htmlentities($row["Edition"]));
                    echo ("</td><td>");
                    echo (htmlentities($row["Year"]));
                    echo ("</td><td>");
                    echo (htmlentities($row["CategoryDescription"]));
                    echo ("</td><td>");
                    echo ('<a href="reserve.php?ISBN=' . htmlentities($row["ISBN"]) . '">Remove</a>');
                    echo ("</td><tr>\n");
                }
            } else {
                echo ("0 results");
            }
            $conn->close();
            ?>

            </table>
        </div>
    <?php } ?>
    <footer class="user-select-none">
        <p>©2024 Created by Cheong Zhi Yuan</p>
    </footer>
</body>

</html>