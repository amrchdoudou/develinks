<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    exit("Not logged in");
}

$current_user = $_SESSION['user']['id'];
$liked_user_id = $_POST['liked_user_id'] ?? null;

if ($liked_user_id && $liked_user_id != $current_user) {
    // Check if already liked
    $check = $connect->prepare("SELECT * FROM liked WHERE user_id = ? AND liked_user_id = ?");
    $check->bind_param("ii", $current_user, $liked_user_id);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows === 0) {
        // Insert like
        $stmt = $connect->prepare("INSERT INTO liked (user_id, liked_user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $current_user, $liked_user_id);
        $stmt->execute();
    }
}
?>