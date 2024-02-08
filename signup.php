<?php

$host = "localhost";
$database = "Test";
$dbusername = "Tom";
$dbpassword = "Tom0306";

try {
    $dsn = "mysql:host=$host;dbname=$database";
    $dbh = new PDO($dsn, $dbusername, $dbpassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $address = $_POST["address"];

        // Check for duplicate username
        $checkUsernameQuery = $dbh->prepare("SELECT username FROM Users WHERE username = ?");
        $checkUsernameQuery->execute([$username]);
        if ($checkUsernameQuery->fetch(PDO::FETCH_ASSOC)) {
            header("Location: userError.php");
        }
        $checkUsernameQuery->closeCursor();

        // Check for duplicate email
        $checkMailQuery = $dbh->prepare("SELECT email FROM Users WHERE email = ?");
        $checkMailQuery->execute([$email]);
        if ($checkMailQuery->fetch(PDO::FETCH_ASSOC)) {
            header("Location: mailError.php");
        }
        $checkMailQuery->closeCursor();

        // Insert new user
        $insertQuery = $dbh->prepare("INSERT INTO Users (username, password, email, address) VALUES (?, ?, ?, ?)");
        $insertQuery->execute([$username, $password, $email, $address]);
        $insertQuery->closeCursor();
        header("Location: welcome.php");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>
