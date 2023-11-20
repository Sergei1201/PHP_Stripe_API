<?php
if (!empty($_GET['tid']) && !empty($_GET['product'])) {
    /* If GET array is not empty, sanitize it and use it in the script to display a purchasing message to the user
        else redirect to the index page
    */
    $GET = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tid = $GET['tid'];
    $product = $GET['product'];
} else {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Thank You</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Thank you for purchasing product <?php echo $product; ?></h3>
        <p class="mt-3">You product ID: <?php echo $tid; ?></p>
        <a href="index.php" class="btn btn-block">Go Back</a>
    </div>

</body>

</html>