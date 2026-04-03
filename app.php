<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (?)");
    $stmt->execute([htmlspecialchars($_POST['title'])]);
}

header('Location: index.php');
exit;
?>