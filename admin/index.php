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
    <title>Administration</title>
</head>
<body>
    <h1>Gestion Administration</h1>
        <a href="membre.php">liste des membres</a>
</body>
</html>