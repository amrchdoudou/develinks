<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    exit("Not logged in");
}

$current_user = $_SESSION['user']['id'];
$liked_user_id = $_POST['liked_user_id'] ?? null;

if ($liked_user_id) {
    $stmt = $connect->prepare("DELETE FROM liked WHERE user_id = ? AND liked_user_id = ?");
    $stmt->bind_param("ii", $current_user, $liked_user_id);
    $stmt->execute();
}
?>