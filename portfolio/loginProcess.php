<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = hash('sha256', $password);

    $stmt = $conn->prepare('SELECT id, email FROM users WHERE email = ? AND password = ?');
    $stmt->bind_param('ss', $email, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header('Location: addEntry.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid email or password. Please try again.';
        header('Location: login.php');
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>