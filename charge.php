<?php

require_once('vendor/autoload.php');

// Set API Keys
\Stripe\Stripe::setApiKey('sk_test_51OEZkeJvE4tJ2lJpG5dCqDtrqwnYPoSm7RJQTVNmnDyEhp2PGZfjyhnJ7ihTKpcwOFGLzyB1HNdNIXDmTraHgZHT00CZgTputT');

// Sanitize Input to prevent from injecting malicious hacker's code into input
$POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Get Input Fields
$firstName = $POST['first_name'];
$last_Name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

var_dump($firstName, $last_Name, $email, $token);

// Create Stripe's Customer
$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token

));

// Charge the Customer
$charge = \Stripe\Charge::create(array(
    "amount" => 20000,
    "currency" => 'rub',
    "description" => "A high quality web development course about programming in PHP and Laravel has been purchased",
    "customer" => $customer->id

));

// Redirect to Success Page after purchasing a course
header('Location: success.php?tid=' . $charge->id . '&product=' . $charge->description);
