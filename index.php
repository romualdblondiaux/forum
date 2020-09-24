<?php
    session_start();
    if(isset($_POST['login'])){
        if($_POST['login']!="" && $_POST['password']!=""){
            require "connexion.php";
            $login=htmlspecialchars($_POST['login']);
            $connexion = $bdd->prepare("SELECT id,login,password,role FROM members WHERE login=?");
            $connexion->execute([$login]);
            if($info=$connexion->fetch()){
                if(password_verify($_POST['password'],$info['password'])){
                    $_SESSION['login']=$info['login'];
                    $_SESSION['id']=$info['id'];
                    $_SESSION['role']=$info['role'];
            }else{
                $error="Votre login ou mot de passe n'est pas correct";
            }
        }else{
            $error="Votre login ou mot de passe n'est pas correct";
        }


        }else{
            $error="Veuillez remplir le formulaire";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if(isset($_GET['register'])){
            echo"<div class='succes'>Vous êtes bien enregistré sur le site! connectez-vous! </div>";
        }
    ?>
    <form action="index.php" method="POST">
        <div>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Connexion">
        </div>
    <?php 
        if(isset($error)){
            echo"<div class='error'>".$error."</div>";
        }
    ?>

    </form>
    <div>
        <a href="inscription.php">Pas encore inscrit?</a>
    </div>
</body>
</html>