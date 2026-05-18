<?php
 declare (strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Carabus Andrei-Sebastian">
    <title>Autentificare</title>
    <link rel="stylesheet" href="/LTWMVC/public/css/style_users.css" type="text/css">
</head>
<body>
    <form action="/LTWMVC/login" method="post" class="login-form">
        <fieldset>
                <div class="login_table">
                    <label for="nume">Nume Utilizator </label>
                    <input type="text" id="nume" name="user" required>
                    <label for="parola">Parola </label>
                    <input type="password" id="parola" name="parola" required>
                    <input type="submit" value="Autentificare">
                </div>
        </fieldset>

        <?php if(isset($_SESSION["BAD_LOGIN"]) && $_SESSION["BAD_LOGIN"] === true):?>
            <p class="red-text" >Numele de utlizator sau parola sunt gresite</p>
        <?php 
        unset($_SESSION["BAD_LOGIN"]); 
        endif;
        ?>
    </form>
    
</body>
</html>