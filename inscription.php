<?php
session_start();

if(isset($_SESSION['id']))
    {
    if($_SESSION['id']==1)
    {
        $id='admin';
        $icon=$_SESSION['prenom'][0].$_SESSION['nom'][0];
    }
    else
    {
        $id='user';
    }
    }
else
{
    $id='none';
}

$conn = mysqli_connect('localhost','root','','moduleconnexion');

if(!empty($_POST["prenom"]) && !empty($_POST["nom"])&& !empty($_POST["login"])&& !empty($_POST["password"]) && !empty($_POST["passwordv"]) )
{
  if($_POST['password'] === $_POST['passwordv'])
  {
  $prenom = $_POST["prenom"];
  $nom = htmlspecialchars($_POST["nom"]);
  $login =  htmlspecialchars($_POST["login"]);
  $password =  htmlspecialchars($_POST["password"]);
  $passwordv =  htmlspecialchars($_POST["password"]);
  $mdp_secure = password_hash($password, PASSWORD_BCRYPT);
  $select = mysqli_query($conn, "SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
    $result_login = mysqli_fetch_all($select);
    if (count($result_login)!==0){
    $intro = 'Ce nom d\'utilisateur existe déjà.';
    $localisation_erreur = 'error_user';
  }
  else
  {
  $add_user = mysqli_query($conn,"INSERT INTO `utilisateurs` (`login`, `prenom`, `nom`, `password`) VALUES ('$login','$prenom','$nom','$mdp_secure')");
  $_SESSION['prenom']=$prenom;
  $_SESSION['login']=$login;
  $_SESSION['nom']=$nom;
  
   header('Location: connexion.php');
  }
  }
  else
  {
    $intro = 'Votre confirmation de mot de passe est invalide';
    $localisation_erreur = 'error_code';
  }
  
}
else {
  $intro= "Veuillez remplir tout les champs pour vous inscrire.";
  $localisation_erreur = null;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php require('meta.php');
?>
  <title>Inscription</title>
</head>
<body class="<?=$id?>_body">
<header>
<?php
require('header.php');
?>
</header>
<video id="video_background_connect" playsinline autoplay muted loop>
        <source src=".\images\background_inscription_animation.mp4" type="video/mp4">
    </video>
  <main>
    <div  class="div_design_mdc">
    <img id="mdc_top"src="images/moodule_top_mdc.png" alt="test">
    </div>
    <div class="test_mdc">
      <h2>Inscription</h2>
      <form class="inscription_form"action="./inscription.php" method="post">
      <p><?=$intro?></p>
      <input type="text" name="prenom" placeholder="Votre prénom"><br>
      <input type="text" name="nom" placeholder="Votre nom"><br>
      <input class="<?=$localisation_erreur?>_login"type="text" name="login" placeholder="Votre login de connexion"><br>
      <input class="<?=$localisation_erreur?>_mdp" type="password" name="password" placeholder="Créer votre mot de passe"><br>
      <input class="<?=$localisation_erreur?>_mdp"type="password" name="passwordv" placeholder="Vérifier votre mot de passe"><br>
      <section class="inscription_bottom_formulaire">
          <input id="input_important" type="submit" value="S'inscire">
        </section>
      </form>
      </div>
    <div  class="div_design_mdc">
    <img id="mdc_bottom"src="images/moodule_bottom_mdc.png" alt="test">
    </div>
  </main>
  <footer>
  <?php
require('footer.php');
?>
  </footer>
</body>
</html>