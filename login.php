<?php
include "db.php";
session_start(); // ✅ Start session at the top

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $connect->prepare("SELECT id, email, password FROM utilisateu WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $fetched_email, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // ✅ Save user info in session
                $_SESSION['user'] = [
                    'id' => $id,
                    'email' => $fetched_email
                ];

                header("Location: interface.php");
                exit();
            } else {
                echo "❌ Wrong password.";
            }
        } else {
            echo "❌ No account found with that email.";
        }

        $stmt->close();
        $connect->close();
    } else {
        echo "❌ Please fill in all fields.";
    }
} else {
    header("Location: loginn.php");
    exit();
}
?>