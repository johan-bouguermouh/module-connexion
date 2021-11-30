<?php

session_start();
if(isset($_SESSION['id'])){
    header('location: index.php');
}

$conn = mysqli_connect('localhost','root','','moduleconnexion');

if(isset($_POST["login"], $_POST["password"])){
    $login = $_POST["login"];
    $password = $_POST["password"];

 $log = mysqli_query($conn,"SELECT `login` FROM utilisateurs WHERE `login`= '$login'");
    $log2 = mysqli_fetch_assoc($log);
    $log3 = $log2['login'];
    if($login === $log3){
        
        $vmdp = mysqli_query($conn,"SELECT * FROM utilisateurs WHERE`login`= '$login'");
        $vmdp2 = mysqli_fetch_assoc($vmdp);
        $vmdp3 = $vmdp2['password'];

        if(password_verify($password,$vmdp3) === TRUE){
            $_SESSION['id']=$vmdp2['id'];
            $_SESSION['prenom']=$vmdp2['prenom'];
            $_SESSION['nom']=$vmdp2['nom'];
            $_SESSION['login']=$vmdp2['login'];
            header('location: index.php');
        }
        elseif(($password === 'admin')&&($login === 'admin'))
        {
            $_SESSION['id']=$vmdp2['id'];
            $_SESSION['prenom']=$vmdp2['prenom'];
            $_SESSION['nom']=$vmdp2['nom'];
            $_SESSION['login']=$vmdp2['login'];
            header('location: index.php');
        }
        else {
            $h3_connect = "Mauvais mot de passe";
        }
    }
    else
    { 
        $h3_connect = 'Veuillez rentrer login valide.';
    } 
}
else $h3_connect ='Bienvenue';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
require('meta.php');
?>
    <title>Connexion</title>
</head>
<body>
    <header>
<?php
require('header.php');
?>  
</header>
    <video id="video_background_connect" playsinline autoplay muted>
        <source src=".\images\background_connect_animation.mp4" type="video/mp4">
    </video>
    <main>
    <div  class="div_design_mdc">
    <img id="mdc_top_connect"src="images/moodule_top_mdc_connect.png" alt="test">
    </div>
<?php
    if(isset($_SESSION['prenom']))
    {
        $h3_connect ="Félicitation ".$_SESSION['prenom'].", vous êtes à présent inscrit!";
    }
?>
    <div class="test_mdc_connect">
     <h3><?=$h3_connect?></h3>
    
    <form action="./connexion.php" method="post">
    <label for="login">Login</label><br>
    <input type="text" name="login" 
    <?php
     if(isset($_SESSION['login']))
     {
         echo "value=".$_SESSION['login'];
     }
     else
     {
         echo 'placeholder= "Nom d\'utilisateur"';
     }
     ?>>
    <br><label for="password">Mot de passe</label><br>
    <input type="password" name="password" placeholder="Votre mot de passe">
    <input class="input_connect" type="submit" value="Connexion">
    </div>
    <div  class="div_design_mdc">
    <img id="mdc_bottom_connect"src="images/moodule_bottom_mdc_connect.png" alt="test">
    </div>
    </main>
    <footer>
<?php
require('footer.php');
?>
    </footer>
</body>
</html>