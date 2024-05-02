<?php
include 'assets/inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $log_id = $_POST['log_id'];
    $sql = "delete from log WHERE user_id=? AND log_id=?";
    $q = $pdo->prepare($sql);
    $q->execute([$user_id, $log_id]);
    header('location: home.php');
} else {
    echo "Bad Request";
}
