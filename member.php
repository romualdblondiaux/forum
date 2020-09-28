<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:index.php");
    }
    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "connexion.php";
    $member = $bdd->prepare("SELECT login, email FROM members WHERE id=?");
    $member->execute([$id]);
    if(!$donMember = $member->fetch()){
        $member->closeCursor();
        header("LOCATION:index.php");
    }
    $member->closeCursor();
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
  <div class="container">
    <h1>Pseudo: <?= $donMember['login'] ?></h1>
    <h2>E-mail: <?= $donMember['email'] ?></h2>

    <h3>Les messages</h3>
    <?php
        $posts = $bdd->prepare("SELECT message, DATE_FORMAT(date, '%d/%m/%Y %Hh%im%Ss') AS mydate FROM post WHERE id_login=? ORDER by date DESC");
        $posts->execute([$id]);
        while($donPost = $posts->fetch()){
            echo "<div class='messages'>";
                echo "<div class='date'>".$donPost['mydate']."</div>";
                echo "<div class='message'>".nl2br($donPost['message'])."</div>";
            echo "</div>";      
        }
        $posts->closeCursor();
    ?>
    <a href="index.php" id='return-button'>Retour</a>
  </div>  
</body>
</html>