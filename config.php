<?php
//this is the configuration file for google login only. 
//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('434072838405-rghl7hibp8lbg0t4o7dqg3lsoagrrin4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('vKbmu2celI7e9GQpT01kzO32');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://garimachaphekar.com/google.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 