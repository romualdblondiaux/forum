<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <div>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login">
        </div>
        <div>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="connexion">
        </div>  
    </form>
        <div>
            <a href="inscription.php">Pas encore inscrit?</a>
        </div>
</body>
</html>