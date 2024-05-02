<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', '');

if (isset($_GET["period"])) {
    $days = 7;

    if ($_GET['period'] == "month") {
        $days = 30;
    } elseif ($_GET['period'] == "year") {
        $days = 360;
    }

    $user_id =  $_SESSION['user_id'];
    $q = $pdo->prepare("SELECT mood, count(*) as count FROM `mood` WHERE user_id=? AND mood_date BETWEEN DATE_SUB(NOW(), INTERVAL ? DAY) AND NOW() + INTERVAL 2 DAY GROUP BY mood");
    $q->execute([$user_id, $days]);
    $berhasil = $q->fetchAll(PDO::FETCH_ASSOC);

    header('Content-type: application/json');
    echo json_encode(
        // array ("status" => 200)
        $berhasil
    );
}

if (isset($_GET['push'])) {
    $moodToPush = $_GET['push'];

    $user_id =  $_SESSION['user_id'];
    $today = date('Y-m-d');

    $q = $pdo->prepare("SELECT id_mood, COUNT(*) AS jumlah FROM mood WHERE mood_date = ? AND user_id= ?");
    $q->execute([$today, $user_id]);
    $row = $q->fetch(PDO::FETCH_ASSOC);

    if ($row['jumlah'] > 0) {
        $mood_id = $row['id_mood'];

        $sql = "update mood SET mood = ? WHERE id_mood=? ";
        $q = $pdo->prepare($sql);
        $q->execute([$moodToPush, $mood_id]);
    } else {
        $q = $pdo->prepare("insert into mood(user_id, mood,mood_date) values(?, ?, ?)");
        $q->execute([$user_id, $moodToPush, $today]);
    }
}
