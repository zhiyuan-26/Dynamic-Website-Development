<?php
session_start();
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e3df38dad5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/table_style.css">
    <link rel="stylesheet" href="../css/search_style.css">
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
            <a class="active-page" href="#">Search</a>
            <a href="view_reserved.php">Reserve</a>
            <a class="logout" href="logout.php">Logout</a>
        </div>

        <div class="body">
            <h1></h1>
            <?php
            $username = $_SESSION['Username']; // display the username
            echo '<h1 class="page-heading">Welcome, ' . $username . '!</h1>';

            // assign searched value if available
            $bookTitle = isset($_POST['BookTitle']) ? trim($_POST['BookTitle']) : (isset($_GET['BookTitle']) ? trim($_GET['BookTitle']) : '');
            $author = isset($_POST['Author']) ? trim($_POST['Author']) : (isset($_GET['Author']) ? trim($_GET['Author']) : '');
            $categoryDescription = isset($_POST['CategoryDescription']) ? trim($_POST['CategoryDescription']) : (isset($_GET['CategoryDescription']) ? trim($_GET['CategoryDescription']) : '');
            ?>

            <!-- search input -->
            <h1 class="content-heading">Search:</h1>
            <form method="post" action="search.php">
                <p>Title:
                    <input class="search" type="text" name="BookTitle" value="<?php echo htmlentities($bookTitle); ?>">
                </p>
                <p>Author:
                    <input class="search" type="text" name="Author" value="<?php echo htmlentities($author); ?>">
                </p>
                <p>Category:
                    <select class="search" name="CategoryDescription">
                        <option value="">All Categories</option>
                        <?php
                        $sql_category = "SELECT CategoryDescription FROM category";
                        $result_category = $conn->query($sql_category);
                        while ($row_category = $result_category->fetch_assoc()) {
                            $selected = $row_category['CategoryDescription'] == $categoryDescription ? 'selected' : '';
                            echo '<option value="' . htmlentities($row_category["CategoryDescription"]) . '" ' . $selected . '>' .
                                htmlentities($row_category['CategoryDescription']) . '</option>';
                        }
                        ?>
                    </select>
                <p><input class="btn" type="submit" value="Search" name="search">
                    <a href="?page=<?php echo 1; ?>" class="btn">Clear</a>
                </p>
            </form>
            <!-- end search input -->

            <?php
            if ($bookTitle || $author || $categoryDescription) {
                $searchResults = 'Search results for "';
                if ($bookTitle) {
                    $searchResults .= '[' . $bookTitle . ']';
                }
                if ($author) {
                    $searchResults .= '[' . $author . ']';
                }
                if ($categoryDescription) {
                    $searchResults .= '[' . $categoryDescription . ']';
                }
                $searchResults .= '"';
                echo $searchResults;
            }

            $rowsPerPage = 5;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $rowsPerPage;

            $condition = "1=1";
            if ($bookTitle) {
                $condition .= " AND BookTitle LIKE '%" . $conn->real_escape_string($bookTitle) . "%'";
            }
            if ($author) {
                $condition .= " AND Author LIKE '%" . $conn->real_escape_string($author) . "%'";
            }
            if ($categoryDescription) {
                $condition .= " AND CategoryDescription LIKE '" . $conn->real_escape_string($categoryDescription) . "'";
            }

            // search and display data
            $sqlRowCount = "SELECT COUNT(*) AS total FROM books b JOIN category c USING(CategoryID) WHERE $condition";
            $totalRowsResult = $conn->query($sqlRowCount);
            $totalRows = $totalRowsResult->fetch_assoc()['total'];
            $totalPages = ceil($totalRows / $rowsPerPage);

            $sql = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryDescription, Reserved FROM books b 
                JOIN category c USING(CategoryID) WHERE $condition LIMIT $rowsPerPage OFFSET $offset";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                //output data of each row in a table
                echo "<table>";
                echo "<th>Title</th>";
                echo "<th>Author</th>";
                echo "<th>Edition</th>";
                echo "<th>Year</th>";
                echo "<th>Category</th>";
                echo "<th>Reservation Status</th>";


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
                    if (htmlentities($row["Reserved"]) == "Y") {
                        echo "Reserved";
                    } else {
                        echo ('<a href="reserve.php?ISBN=' . htmlentities($row["ISBN"]) . '">Available</a>');
                    }
                    echo ("</td><tr>\n");
                } ?>
                </table>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&BookTitle=<?php echo urlencode($bookTitle); ?>
                    &Author=<?php echo urlencode($author); ?>&CategoryDescription=<?php echo urlencode($categoryDescription); ?>">
                            <i class="fa-solid fa-chevron-left"></i></a>
                    <?php else: ?>
                        <a class="disabled" disabled><i class="fa-solid fa-chevron-left"></i></a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>&BookTitle=<?php echo urlencode($bookTitle); ?>
                        &Author=<?php echo urlencode($author); ?>&CategoryDescription=<?php echo urlencode($categoryDescription); ?>"
                            class="<?php echo ($i == $page) ? 'active-page' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&BookTitle=<?php echo urlencode($bookTitle); ?>
                    &Author=<?php echo urlencode($author); ?>&CategoryDescription=<?php echo urlencode($categoryDescription); ?>">
                            <i class="fa-solid fa-chevron-right"></i></a>
                    <?php else: ?>
                        <a class="disabled" disabled><i class="fa-solid fa-chevron-right"></i></a>
                    <?php endif; ?>
                </div>
            <?php } else {
                echo ("0 results");
            } ?>
            <?php $conn->close(); ?>
        </div>
    <?php } ?>
    <footer class="user-select-none">
        <p>©2024 Created by Cheong Zhi Yuan</p>
    </footer>
</body>

</html>