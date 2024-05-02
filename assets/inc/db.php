<?php
session_start();

if (!isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
    header('Location: index.php');
    die();
}
$user_id = $_SESSION['user_id'];

$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', '');?>
