<?php
        if(isset($_GET['register'])){
            echo "<div class='success'>Vous êtes bien enregistré sur le site! connectez-vous! </div>";
        }
    ?>
  
    <form action="index.php" method="POST" id="form-connex">
    <h1>Exercice Forum</h1>
        <div class="form-group">
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe: </label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Connexion">
        </div>
        <?php
            if(isset($error)){
                echo "<div class='error'>".$error."</div>";
            }
        ?>
        <div id="register-link">
            <a href="inscription.php">Pas encore inscrit?</a>
        </div>
    </form>