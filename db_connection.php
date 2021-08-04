<?php

$servername = "localhost";
$username = "lektorium";
$password = "Lektorium_123";
$dbname = "lektorium";

$pdoConn = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
