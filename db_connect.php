<?php
//database_connection.php

$connect = new PDO("mysql:host=ec2-46-137-177-160.eu-west-1.compute.amazonaws.com;dbname=d5rtbedq9bdrfc", "fqejpaaxlapkgo", "2425cd44adfb03a257d8106c2a20d29342f76571433e09f18cff277b8eeb2e86
");

session_start();

$_SESSION["user_id"] = "1";