<section>
    <a href="index.php">Accueil</a>
    <div class="lateral_cesure_footer"></div>
<?php

    if(isset($_SESSION['id']))
    {
    if($_SESSION['id']==1)
    {
    ?>
        <a href="Gestionnaire.php">Gestionnaire</a>
        <div class="lateral_cesure_footer"></div>
        <a href="deconnexion.php">Se déconnecter</a>
    <?php
    }
    elseif(isset($_SESSION['id']))
    {
    ?>
        <a href="profil.php">Mon compte</a>
        <div class="lateral_cesure_footer"></div>
       <a href="deconnexion.php">Se déconnecter</a>
    <?php
    }
    }
    else
    {
    ?>
        <a href="inscription.php">S'inscrire</a>
        <div class="lateral_cesure_footer"></div>
        <a href="connexion.php">Se connecter</a>
    <?php
    }
    ?>
</section>