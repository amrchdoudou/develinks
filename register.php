<?php
ob_start(); // ← يمنع أي output قبل header

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $connect->prepare("INSERT INTO utilisateu (nom, prenom, email, password) VALUES (?, ?, ?, ?)");  
      $stmt->bind_param("ssss", $name, $fullname, $email, $password);

    if ($stmt->execute()) {
        header("Location: loginn.php");
        exit();
    } else {
        echo "❌ التسجيل فشل: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();
}

ob_end_flush(); // ← يخلي الأمور ترجع عادية بعد التوجيه
?>