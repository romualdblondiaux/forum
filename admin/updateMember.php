<?php
    session_start();
    if(isset($_SESSION['role'])){
        if($_SESSION['role']!="ROLE_ADMIN"){
            header("LOCATION:403.php");
        }

    }else{
        header("LOCATION:403.php");
    }

    if(isset($_GET['id'])){
       $id=htmlspecialchars($_GET['id']); 
       require "../connexion.php";
       $user = $bdd->prepare("SELECT * FROM members WHERE id=?");
       $user->execute([$id]);
       if(!$donUser = $user->fetch()){
           $user->closeCursor();
            header("LOCATION:403.php");
       }
       $user->closeCursor();
    }else{
        header("LOCATION:403.php");
    }

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <title>Administration - Forum - Membre : <?= $donUser['login'] ?></title>
</head>
<body>
    <div class="container">
        <h1>Administration - Forum - Membre : <?= $donUser['login'] ?></h1>
        <a href="members.php" class="btn btn-secondary my-3">Retour</a>
        <form action="treatmentUpdateMember.php?id=<?= $donUser['id'] ?>" method="POST">
            <div class="form-group">
                <label for="login">Login: </label>
                <input type="text" id="login" name="login" placeholder="Votre login" class="form-control" value="<?= $donUser['login'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" class="form-control" value="<?= $donUser['email'] ?>">
            </div>
            <div class="form-group">
                <label for="role">Rôle</label>
                <select name="role" id="role" class="form-control">
                    <?php
                        if($donUser['role']=="ROLE_ADMIN")
                        {
                            echo '<option value="ROLE_USER">Utilisateur</option>';
                            echo '<option value="ROLE_ADMIN" selected>Administrateur</option>';
                        }else{
                            echo '<option value="ROLE_USER" selected>Utilisateur</option>';
                            echo '<option value="ROLE_ADMIN">Administrateur</option>';
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
        </form>
    
    
    </div>
</body>
</html>