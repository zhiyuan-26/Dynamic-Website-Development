<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="Username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="Password" id="password"
                    placeholder="Password" pattern=".{6,20}"
                    title="Must have at least 6 characters" required>
            </div>
            <div class="input-group">
                <input type="password" name="ConfirmPassword" id="confirm-password"
                    placeholder="Confirm Password" required>
            </div>
            <div class="input-group">
                <input type="text" name="FirstName" id="first-name"
                    placeholder="First Name" required>
            </div>
            <div class="input-group">
                <input type="text" name="Surname" id="surname"
                    placeholder="Surname" required>
            </div>
            <div class="input-group">
                <p><input type="text" name="AddressLine1" id="address-line1"
                        placeholder="Address Line 1" required></p>
                <p><input type="text" name="AddressLine2" id="address-line2"
                        placeholder="Address Line 2"></p>
            </div>
            <div class="input-group">
                <input type="text" name="City" id="city"
                    placeholder="City" required>
            </div>
            <div class="input-group">
                <input type="tel" name="Telephone" id="telephone" placeholder="Telephone"
                    pattern="0+[0-9]{7}" title="Must have eight numbers, eg: 01554655">
            </div>
            <div class="input-group">
                <input type="tel" name="Mobile" id="mobile" placeholder="Mobile"
                    pattern="0+[0-9]{9}" title="Must have 10 numbers, eg: 0851554655" required>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <?php
        if (isset($_GET['register_failed'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['register_failed']) . '</p>';
        }
        if (isset($_GET['passwordNotMatch'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['passwordNotMatch']) . '</p>';
        }
        ?>
        <p class="or">------or------</p>
        <div class="links">
            <p>Already Have An Account?</p>
            <a href="index.php" id="signInButton">Sign In</a>
        </div>
    </div>
</body>

</html>