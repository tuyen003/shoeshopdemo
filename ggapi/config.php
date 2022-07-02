<?php

//start session on web page
// session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('404925619828-df9vuhmks918n3d4fd4d73vb12rdaec6.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
// $google_client->setRedirectUri('http://localhost/shoeshop.vn/login.php');
$google_client->setRedirectUri('https://php-shoeshop.herokuapp.com/login');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>

