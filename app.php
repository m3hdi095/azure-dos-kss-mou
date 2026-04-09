<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['title'])) {
        $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (?)");
        $stmt->execute([htmlspecialchars($_POST['title'])]);
    } elseif (!empty($_POST['delete_id'])) {
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([(int) $_POST['delete_id']]);
    }
}

header('Location: index.php');
exit;
?>