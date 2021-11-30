

    <nav>
<?php
if(isset($_SESSION['id'])){
if($_SESSION['id']==1)
{
?>
    <img src="images/moodule_logo_white.png" alt="présentation du logo de la page web">
<?php
}
else{
?>
        <img src="images/moodule_logo.png" alt="présentation du logo de la page web">
<?php
}
}
else{
?>
        <img src="images/moodule_logo.png" alt="présentation du logo de la page web">
<?php
}
if(isset($_SESSION['id']))
{
    $icon=$_SESSION['prenom'][0].$_SESSION['nom'][0];
?>
        <section>
            <h3><?=$_SESSION['prenom']?></h3>           
            <div class="<?=$id?>_icon_login">
                <p><?=$icon?></p>
            </div>
            <div class="menu_nav_header">
            <a class="target_button" href="#target_nav_header"><i class="fas fa-ellipsis-v"></i></a>
                <ul id="target_nav_header">
<?php
            if($_SESSION['id']!=1)
            {
?>
                <li><a href="profil.php">Mon compte</a></li>
                <li><div class="span_line"></div></li>      
<?php
    }
    if($_SESSION['id']==1){
?>
                <li><a href="Gestionnaire.php">Gestionnaire</a></li>
                <li><div class="span_line"></div></li>
<?php 
    }
?>
                <li><a href="deconnexion.php">Se déconnecter</a></li>
                <li><div class="span_line"></div></li>
                <li><a href="#"><i class="fas fa-angle-up"></i></a></li>
                </ul>
            <div>

        </section>
        <?php
            }
            else
            {
        ?>
            <section class="header_nav_section_bouton">
                <div class="header_nav_bouton"><a  href="connexion.php">Se connecter</a></div>
                <div class="header_nav_bouton"><a  href="inscription.php">S'inscrire</a><div>
            </section>
        <?php
            }
        ?>
    </nav>
