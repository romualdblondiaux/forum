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
                    $error="Votre login ou votre mot de passe n'est pas correct";
                }
            }else{
                $error="Votre login ou votre mot de passe n'est pas correct";
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
                header("LOCATION:index.php"); // pour éviter d'avoir le message renvoyer formulaire
            }else{
                $postError="veuillez donner un message";
            }
        }

    }

    if(isset($_GET['deco'])){
        session_destroy();
        header("LOCATION:index.php");
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['login'])){
    ?>  
        <div class="container">   
            <h1>Bonjour <?= $_SESSION['login'] ?></h1>
            
            <a id='deco-button' href="index.php?deco=accept">Déconnexion</a>
            <?php
                if($_SESSION['role']=="ROLE_ADMIN"){

                    echo '<a href="admin/">Administration</a>';
                }
            ?>
    
            <h3>Les messages</h3>
            <?php
                $posts = $bdd->query("SELECT members.login AS pseudo, members.id AS id_pseudo, post.message AS message, DATE_FORMAT(post.date, '%d/%m/%Y %Hh%im%Ss') AS mydate FROM post INNER JOIN members ON post.id_login=members.id ORDER BY post.date DESC");
                while($donPost = $posts->fetch()){
                    echo "<div class='messages'>";
                        echo "<div class='auteur'><a href='member.php?id=".$donPost['id_pseudo']."'>".$donPost['pseudo']."</a></div>";
                        echo "<div class='date'>".$donPost['mydate']."</div>";
                        echo "<div class='message'>".nl2br($donPost['message'])."</div>";
                    echo "</div>";    
                }
                $posts->closeCursor();
            ?>
    
    
            <form action="index.php" method="POST" >
                <div>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <input type="submit" value="envoyer">
                </div>
                <?php
                    if(isset($postError)){
                        echo "<div class='post-error'>Veuillez remplir le formulaire</div>";
                    }
                ?>
            </form>
        </div>

        
    <?php        
        }else{
            include("formConnex.php");
        } 
    ?>
</body>
</html>