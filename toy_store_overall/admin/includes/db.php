<?php

$db_name = 'mysql:host=localhost;dbname=toy_store';
$user_name = 'root';
$user_password = '';

// Use $pdo consistently everywhere
$pdo = new PDO($db_name, $user_name, $user_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>