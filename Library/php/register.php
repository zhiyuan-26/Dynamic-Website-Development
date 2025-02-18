<?php
require_once "database.php";

if (isset($_POST['signUp'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $confirm_password = $_POST['ConfirmPassword'];
    $firstName = $_POST['FirstName'];
    $surname = $_POST['Surname'];
    $addressLine1 = $_POST['AddressLine1'];
    $addressLine2 = $_POST['AddressLine2'];
    $city = $_POST['City'];
    $telephone = $_POST['Telephone'];
    $mobile = $_POST['Mobile'];

    $checkUsername = "SELECT * FROM users WHERE Username='$username'";

    if ($confirm_password != $password) {
        $passwordNotMatch = "Passwords do not match! Please try again.";
        header("location: sign_up.php?passwordNotMatch=" . urlencode($passwordNotMatch));
        exit();
    }

    $result = $conn->query($checkUsername);
    if ($result->num_rows > 0) {
        $register_failed = "Username Already Exists!";
        header("location: sign_up.php?register_failed=" . urlencode($register_failed));
        exit();
    } else {
        $sql = "INSERT INTO users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
            VALUES ('$username', '$password', '$firstName', '$surname', '$addressLine1', '$addressLine2', '$city', '$telephone', '$mobile')";

        if ($conn->query($sql) == TRUE) {
            header("location: search.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['Username'] = $row['Username'];
        header("Location: search.php");
        exit();
    } else {
        $login_failed = "Incorrect Username or Password!";
        header("location: index.php?login_failed=" . urlencode($login_failed));
        exit();
    }
}
