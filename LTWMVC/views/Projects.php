<?php
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Projects</title>
</head>
<body>
    <h1>Salut, <?= htmlspecialchars($userName) ?>!</h1>
    <?php if($projects!==[]):?>
        <h2>Proiectele unde esti colaboratoare:</h2>
    <ul>
    <?php foreach($projects as $project_data): ?>
        <a href="/LTWMVC/issues?projectId=<?= $project_data['id'] ?>">
            <?= htmlspecialchars($project_data["name"]) ?>
        </a>       
    <?php  endforeach; ?>
    </ul>
    <?php else: ?>
    <h2>Nu esti colaborator la nici un proiect.</h2>
    <?php endif;?>
    <form action="/LTWMVC/projects" method="post">
        <input type="hidden" name="LOG_OUT" value=1> 
        <input type="submit" value="Logout">
    </form>
</body>
</html>