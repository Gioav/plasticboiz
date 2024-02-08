<?php

$host = "localhost";
$database = "Test";
$username = "Tom";
$password = "Tom0306";

try {
    $dsn = "mysql:host=$host;dbname=$database";
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $enteredUsername = $_POST["username"];
        $enteredPassword = $_POST["password"];

        // Check if the user exists
        $checkUserQuery = $dbh->prepare("SELECT * FROM Users WHERE username = ? AND password = ?");
        $checkUserQuery->execute([$enteredUsername, $enteredPassword]);

        // Fetch the user data
        $user = $checkUserQuery->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User exists, you can perform further actions here
            header("Location: main.php");
	    exit();
        } else {
            // User does not exist
            echo "Invalid username or password.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesign.css" media="screen">
    <title>Login</title>
</head>
<body>
    <div class="content-container">
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    </div>
</body>
</html>
