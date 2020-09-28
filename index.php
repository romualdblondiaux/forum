<?php
    session_start();
    require "connexion.php";
    if(isset($_POST['login'])){
        if($_POST['login']!="" && $_POST['password']!=""){
            
            $login=htmlspecialchars($_POST['login']);
            $connexion = $bdd->prepare("SELECT id,login,password,role FROM members WHERE login=?");
            $connexion->execute([$login]);
            if($info=$connexion->fetch()){
                if(password_verify($_POST['password'],$info['password'])){
                    $_SESSION['login']=$info['login'];
                    $_SESSION['id']=$info['id'];
                    $_SESSION['role']=$info['role'];
                    header("LOCATION:index.php");
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
    if(isset($_SESSION['id'])){
        if(isset($_POST['message'])){
            if($_POST['message']!=""){
                $message=htmlspecialchars($_POST['message']);
                $insert = $bdd->prepare("INSERT INTO post(id_login,date,message) VALUES(:id,NOW(),:message)");
                $insert->execute([
                    ":id"=>$_SESSION['id'],
                    ":message"=>$message
                ]);
                $insert->closeCursor();
                header("LOCATION=index.php"); // pour eviter d'avoir le message renvoyer formulaire
            }else{
                $posterror="Veuillez donner un message";
            }
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
        if(isset($_SESSION['login'])){
    ?>
    <h1>Bonjour <?= $_SESSION['login'] ?></h1>

    <h3> les messages</h3>
    <?php 
        $posts= $bdd->query("SELECT members.login AS pseudo, members.id AS id_pseudo, post.message AS message, DATE_FORMAT(post.date, '%d/%m/%Y %Hh%im%Ss') AS mydate FROM post INNER JOIN members ON post.id_login=members.id ORDER BY post.date ASC");
        while($donPost = $posts->fetch()){
            echo "<div class='messages'>";
                echo "<div class='auteur'><a href='member.php?id=".$donPost["id_pseudo"]."'>".$donPost["pseudo"]."</a></div>";
                echo "<div class='date'>".$donPost["mydate"]."</div>";
                echo "<div class='message'>".nl2br($donPost["message"])."</div>";
            echo "</div>";
        }
        $posts->closeCursor();
    ?>

    <form action="index.php" method="POST">
        <div>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="envoyer">
        </div>
        <?php 
            if(isset($posterror)){
                echo "<div class='post-error'>Veuillez remplir le formulaire</div>";
            }
        ?>
    </form>


    <?php 
        }else{
            //fermeture en bas de la page
    
    ?>


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

    <?php 
        } // fermeture du test isset
    ?>
</body>
</html>