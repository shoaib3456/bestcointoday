<?php

//start session on web page
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('778269609550-u4nf287stlhpu8mu2iai3l7n0be0238p.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('Cw8UKelwMGqP2enHf76Hp2gW');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/gemvotes/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>