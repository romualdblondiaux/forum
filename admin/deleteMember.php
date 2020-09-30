<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }
    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
        require "../connexion.php";
        $member = $bdd->prepare("SELECT * FROM members WHERE id=?");
        $member->execute([$id]);
        if(!$donMember = $member->fetch()){
            $member->closeCursor();
            header("LOCATION:index.php");
        }
        $member->closeCursor();
    }else{
        header("LOCATION:403.php");
    }

    if(isset($_GET['delete'])){
        // supprimer les messages
        $deletePost = $bdd->prepare("DELETE FROM post WHERE id_login=?");
        $deletePost->execute([$id]);
        $deletePost->closeCursor();

        // supprimer l'utilisateur
        $deleteUser = $bdd->prepare("DELETE FROM members WHERE id=?");
        $deleteUser->execute([$id]);
        $deleteUser->closeCursor();

        header("LOCATION:members.php?delete=success");
    }
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style.css">
    <title>Administration - Forum - Gestion des membres</title>
</head>
<body>
  <div class="container">
    <h1>
        <span>Supprimer: <?= $donMember['login'] ?></span>
        <a href="deleteMember.php?delete=accept&id=<?= $donMember['id'] ?>" class="btn btn-danger ml-2">Oui</a>
        <a href="members.php" class="btn btn-secondary mx-1">Non</a>
    </h1>
    
    <h2>E-mail: <?= $donMember['email'] ?></h2>

    
    <?php
        $posts = $bdd->prepare("SELECT message, DATE_FORMAT(date, '%d/%m/%Y %Hh%im%Ss') AS mydate FROM post WHERE id_login=? ORDER by date DESC");
        $posts->execute([$id]);
        $nbPost = $posts->rowCount(); // permet d'avoir le nombre de message(s)
        echo "<h3>Les messages <span class='badge badge-primary'>".$nbPost."</span></h3>";
        if($nbPost > 0){
            while($donPost = $posts->fetch()){
                echo "<div class='messages'>";
                    echo "<div class='date'>".$donPost['mydate']."</div>";
                    echo "<div class='message'>".nl2br($donPost['message'])."</div>";
                echo "</div>";      
            }
        }else{
            echo "aucun message...";
        }
        $posts->closeCursor();
    ?>
  
  </div>  
</body>
</html>