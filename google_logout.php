<?php

//logout.php

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
//header('Location:index.php');
echo "<script>window.open('index.php','_self')</script>";
exit();
?>