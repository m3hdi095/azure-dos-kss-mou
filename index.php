<?php
require 'db.php';
$tasks = $pdo->query("SELECT * FROM tasks ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>📝 Todo List</h1>

    <form action="app.php" method="POST">
        <input type="text" name="title" placeholder="Nouvelle tâche..." required>
        <button type="submit">Ajouter</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?= htmlspecialchars($task['title']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>