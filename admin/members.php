<?php
    session_start();
    if(isset($_SESSION['role'])){
        if($_SESSION['role']!="ROLE_ADMIN"){
            header("LOCATION:403.php");
        }

    }else{
        header("LOCATION:403.php");
    }
    require "../connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <title>Administration - Forum - Gestion des membres</title>
</head>
<body>
    <div class="container">
        <h1>Administration - Forum - Gestion des membres</h1>
        <a href="index.php" class="btn btn-secondary my-3">Retour</a>
        <table class="table table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Login</th>
                    <th>E-mail</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $users = $bdd->query("SELECT * FROM members");
                    while($donUser = $users->fetch()){
                        echo "<tr>";
                            echo "<td>".$donUser['id']."</td>";
                            echo "<td>".$donUser['login']."</td>";
                            echo "<td>".$donUser['email']."</td>";
                            echo "<td>".$donUser['role']."</td>";
                            echo "<td>";
                                echo "<a href='updateMember.php?id=".$donUser['id']."' class='btn btn-warning'><i class='fas fa-pen'></i></a>";
                                // interdire qu'un admin se supprime 
                                if($_SESSION['id']!=$donUser['id'])
                                {
                                    echo "<a href='deleteMember.php?id=".$donUser['id']."' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                                    // NB: on peut aussi protéger le fichier delete de ce genre de cas
                                }
                            echo "</td>";
                        echo "</tr>";
                    }
                    $users->closeCursor();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>