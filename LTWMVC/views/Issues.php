<?php 
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Carabus Andrei-Sebastian">
    <title><?= $project_info["name"] ?> - Issues</title>
    <link rel="stylesheet" href="/LTWMVC/public/css/style_issues.css" type="text/css">
</head>
<body>
    <main>
        <h1><?= $project_info["name"] ?></h1>
        <h2>Detalii proiect</h2>
        <p>
        <strong>Descriere proiect: </strong>
        <?= $project_info["description"] ?>
        </p>
    </main>
    <section id="echipe">
        <div>Echipa Proiectului</div>
        <div class="grid_table">
            <div class="grid_table_header">Nr</div>
            <div class="grid_table_header">Nume</div>
            <div class="grid_table_header">Functie</div>

            <?php
            $index=1; 
            foreach($contributors as $contributor_data): 
                $culoare_rand=($index%2==0) ? 'aqua':'';
                $emoji='🐞';
                $rol=$contributor_data["team_function"] ?? 'tester';

                if(stripos($rol,'manager')!==false){
                    $emoji = '👑';
                }

                if(stripos($rol,'developer')!==false){
                    $emoji = '💻';
                }
            ?>
            <div class="grid_table_simple <?= $culoare_rand ?>"><?= $index ?></div>
            <div class="grid_table_simple <?= $culoare_rand ?>"><?= $contributor_data["user_name"] ?></div>
            <div class="grid_table_simple <?= $culoare_rand ?>"><?= $emoji ?> <?= $rol ?></div>
            <?php
            $index++; 
            endforeach; 
            ?>

        </div>
    </section>
    <?php if($issues!==[]): ?>
    <section id="erori">
        <h2>Lista erori</h2>
        <?php foreach($issues as $error_data): ?>
            <div>
                <h3><?= $error_data['title'] ?></h3>
                <p><?= $error_data['description'] ?></p>
                <p><strong>Raportat de: </strong><?= $error_data['user_name'] ?></p>
                <p><strong>Data: </strong><?= date("d-m-Y", strtotime($error_data['created_at'])) ?></p>
            </div>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
    <section id="adauga_eroare">
        <h2>Adauga eroare</h2>
        <form action="/LTWMVC/issues/" method="post">
            <fieldset>
                <legend><strong>Descriere eroarea</strong></legend>
                <div class="table_add_error">
                    <label for="titlu_eroare">Titlu</label>
                    <input type="text" id="titlu_eroare" placeholder="Dati un titlu" name="title" required>

                    <label for="descriere_eroare">Descriere</label>
                    <textarea id="descriere_eroare" name="description"></textarea>

                    <div></div>
                    <input type="submit" value="Raporteaza">
   
                </div>
            </fieldset>
        </form>
        <br>
        <form action="/LTWMVC/issues/" method="post">
            <input type="hidden" name="LOG_OUT"> 
            <input type="submit" value="Logout">
        </form>
    </section>
</body>
</html>