<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $datetime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare('INSERT INTO posts (title, body, created_at) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $title, $content, $datetime);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: viewBlog.php');
    exit();
}
?>