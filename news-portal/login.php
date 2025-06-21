<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        echo "<script>alert('Login successful!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid email or password!'); window.history.back();</script>";
    }
}
?>
