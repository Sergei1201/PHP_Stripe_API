<?php
// Loading Stripe
require_once('vendor/autoload.php');
require_once('./config/db.php');
require_once('./lib/pdo_db.php');
require_once('./models/Customer.php');

// Set Stripe API Keys
\Stripe\Stripe::setApiKey('sk_test_51OEZkeJvE4tJ2lJpG5dCqDtrqwnYPoSm7RJQTVNmnDyEhp2PGZfjyhnJ7ihTKpcwOFGLzyB1HNdNIXDmTraHgZHT00CZgTputT');

// Sanitize user's input to prevent data from injecting malicious code by an attacker
$POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Get user's input thus grabbing it by the name attribute of the input form
$firstName = $POST['first_name'];
$lastName = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

// var_dump($firstName, $lastName, $email, $token);

// Create a customer
$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token

));

// Charge the customer
$charge = \Stripe\Charge::create(array(
    "amount" => 250000,
    "currency" => "rub",
    "description" => "Purchasing JavaScript course for advanced developers",
    "customer" => $customer->id

));

$customerData = [
    'id' => $charge->customer,
    'firstName' => $firstName,
    'lastName' => $lastName,
    'email' => $email
];

// Create an instance of a customer
$customer = new Customer();

// Add the customer to the database
$customer->addCustomer($customerData);

// Redirect to success page
header('Location: success.php?tid=' . $charge->id . '&product=' . $charge->description);
