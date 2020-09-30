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

     if(isset($_POST['login'])){
         $err=0;
        if(!empty($_POST['login'])){
            $login = htmlspecialchars($_POST['login']);
            // vérifier si le login a changé MAIS si c'est le cas, vérifier qu'il n'est pas déjà utilisé!
            if($login != $donUser['login']){
                $users = $bdd->prepare("SELECT * FROM members WHERE login=?");
                $users->execute([$login]);
                if($doubleUser = $users->fetch()){
                    $err=2;
                }
            } 
        }else{
            $err=1;
        }

        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$#", $_POST['email'])){
            $email=$_POST['email']; // pas besoin de protection, la regex a déjà tout vérif
        }else{
            $err=3;
        }

        if(!empty($_POST['role'])){
            $role = htmlspecialchars($_POST['role']);
        }else{
            $err=4;
        }
       

        if($err==0){
            $update= $bdd->prepare("UPDATE members SET login=:log, email=:mail, role=:level WHERE id=:myid");
            $update->execute([
                ":log"=>$login,
                ":mail"=>$email,
                ":level"=>$role,
                ":myid"=>$id
            ]);
            $update->closeCursor();
            header("LOCATION:members.php?update=success");
        }else{
            header("LOCATION:updateMember.php?id=".$id."&error=".$err);
        }




     }else{
         header("LOCATION:members.php");
     }

?>
