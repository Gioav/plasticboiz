<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Information</title>
</head>
<body>

<?php
// Check if the image parameter is set in the URL
if(isset($_GET['image'])) {
    $imageName = $_GET['image'];

    echo '<h1>Image Information</h1>';
    echo '<p>Clicked Image: ' . $imageName . '</p>';

    // Get the file extension of the image
    $extention = array('jpg', 'jpeg', 'png', 'gif');
    $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);

    // Check if the file extension is allowed
    foreach($extention as $ex){
        echo '<img src="Images/'.$imageName.$ex'">';
    }
}
?>

</body>
</html>
