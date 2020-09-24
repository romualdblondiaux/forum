<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>inscription</h1>  
    <form action="treatmentRegister.php" method="POST">
        <div>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" placeholder="Votre login">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" placeholder="Votre adresse e-mail">
        </div>
        <div>
            <label for="pass1">Mot de passe</label>
            <input type="password" id="pass1" name="password">
        </div>
        <div>
            <input type="submit" value="Inscription">
        </div>
    </form> 
</body>
</html>