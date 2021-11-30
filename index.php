
<?php
session_start();
if(isset($_SESSION['id']))
    {
    if($_SESSION['id']==1)
    {
        $id='admin';
    }
    else
    {
        $id='user';
    }
    }
else
{
    $id='none';
    $img_accueil='images/moodule_background_index_none.png';
}

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

    <title>Acceuil</title>
</head>

<body class="<?=$id?>_body">
<header>
<?php
require('header.php');
?>
</header>
<main>
    
<?php
    if(isset($_SESSION['prenom'])){
?>
        <h2>Bonjour <?=$_SESSION['prenom']?></h2>
<?php
        }
        else
        {
        
?>
         <img src="<?=$img_accueil?>" alt="illustration de bienvenue">
<?php
        }
?>
</main>
<footer>
<?php
require('footer.php');
?>
</footer>
</body>
</html>