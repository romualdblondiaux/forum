<?php
    if(!isset($_SESSION['id'])){
        header("LOCATION:index.php");
    }

    if(!isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "connexion.php";
    $post = $bdd->prepare("SELECT * FROM post WHERE id=?");
    $post->execute([$id]);
    if($donPost = $post->fetch()){
        // test si le message appartient aà notre utilisateur connecté
        if($_SESSION['id']!=$donPost['id_login']){
            header("LOCATION:index.php");
        }
    }else{
        header("LOCATION:index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>