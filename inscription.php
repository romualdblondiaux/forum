<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="treatmentRegister.php" method="POST" id="inscription">
        <h1>Inscription</h1>  
        <div class="form-group">
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" placeholder="Votre login" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass1">Mot de passe</label>
            <input type="password" id="pass1" name="password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Inscription">
        </div>
        <?php 
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case 1:
                        echo "<div class='error'>Veuillez remplir correctement le formulaire</div>";
                    break;
                    case 2:
                        echo "<div class='error'>Login déjà utilisé, veuillez en choisir un autre</div>";
                    break;
                    case 3:
                        echo "<div class='error'>Veuillez remplir correctement le formulaire</div>";
                    break;
                    case 4:
                        echo "<div class='error'>Votre adresse e-mail n'est pas valide</div>";
                    break;
                    case 5:
                        echo "<div class='error'>Veuillez remplir correctement le formulaire</div>";
                    break;
                    default:
                        echo "<div class='error'>Veuillez remplir correctement le formulaire</div>";
                }
            }
        ?>
    </form> 
</body>
</html>