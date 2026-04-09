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
<div class="container">
    <h1>📝 Todo List</h1>

    <form action="app.php" method="POST">
        <input type="text" name="title" placeholder="Nouvelle tâche..." required>
        <button class="add-btn" type="submit">Ajouter</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <span><?= htmlspecialchars($task['title']) ?></span>
                <form action="app.php" method="POST" style="margin:0">
                    <input type="hidden" name="delete_id" value="<?= $task['id'] ?>">
                    <button class="del-btn" type="submit" title="Supprimer">✕</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>