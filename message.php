<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: loginn.php');
    exit();
}

$expediteur_id = $_SESSION['user']['id'];
$destinataire_id = $_POST['destinataire_id'];
$contenu = trim($_POST['contenu']);

if ($destinataire_id && $contenu !== '') {
    $sql = "INSERT INTO message (id_expediteur, id_destinataire, contenu) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("iis", $expediteur_id, $destinataire_id, $contenu);
    $stmt->execute();
}

// ✅ Go back to the same chat box after sending the message
header('Location: interface.php?chat_with=' . urlencode($destinataire_id));
exit();
?>