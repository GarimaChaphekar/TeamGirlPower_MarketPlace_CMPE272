<?php

define('DB_SERVER', 'garima1627m72537.ipagemysql.com');
define('DB_USERNAME', 'superman');
define('DB_PASSWORD', 'Profit@11');
define('DB_NAME', 'assign');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($con == false){
    dir('Error: Cannot connect');
}

?>