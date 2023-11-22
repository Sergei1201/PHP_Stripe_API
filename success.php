<?php
/* Checking if there's product's ID and description in URL params
    If there's one, sanitize the input array and use it for displaying information to the user
    else return to the index page
*/
if (!isset($_GET['tid']) && !isset($GET['product'])) {
    header('Location: index.php');
} else {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $product = $GET['product'];
    $tid = $GET['tid'];
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
        <h3>Thank you for purchasing the product <?php echo $product; ?></h3>
        <p class="mt-3">
            You product ID: <?php echo $tid; ?>
        </p>

    </div>

</body>

</html>