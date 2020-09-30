<?php
    session_start();
    if(isset($_SESSION['role'])){
        if($_SESSION['role']!="ROLE_ADMIN"){
            header("LOCATION:403.php");
        }

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
    <title>Administration - Forum</title>
</head>
<body>
    <div class="container">
        <h1>Administration - Forum</h1>
        <a href="../index.php?deco=accept" class="btn btn-secondary m-2">Déconnexion</a>
        <a href="../index.php" class="btn btn-secondary m-2">Revenir au site</a>
        <h3><a href="members.php">Gestion des membres</a></h3>
    </div>
</body>
</html>