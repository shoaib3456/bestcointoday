<?php

//logout.php


include('google-config.php');

//Reset OAuth access token
// $google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:login.php');

?>