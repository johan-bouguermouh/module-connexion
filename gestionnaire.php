<?php
session_start();
if(isset(($_SESSION['id'])))
{
    if($_SESSION['id']!=1)
    {
        header('location: index.php');
    }
}
else  header('location: index.php');
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
}

$conn = mysqli_connect('localhost','root','','moduleconnexion');
$log = mysqli_query($conn,"SELECT * FROM utilisateurs");
$user = mysqli_fetch_all($log,MYSQLI_ASSOC);

$i=1;
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
    <title>gestionnaire</title>
</head>
<body class="<?=$id?>_body">
    <header>
        <?php
        require('header.php');
        ?>
    </header>
    <main class="main_gestionnaire">
    <section>
        <h1>Gestionnaire d'utilisateurs</h1>
        <?php while(isset($user[$i])){
            if($i>=2)
            {
            $k=$i-1;
            }
            else
            {
                $k=$i;
            }
?>
    <table>
        <thead>
            <tr>
                <td><b><?=$user[$i]['prenom']?> <?=$user[$i]['nom']?></b></td>
                <td>
                <form action="gestionnaire.php" method="post">
                    <button type="submit" name="<?=$i?>" value="<?=$user[$i]['id']?>">Suprimer</button>
                </form>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>login :</td>
                <td><?=$user[$i]['login']?></td>
            </tr>
            <tr>
                <td>Prenom :</td>
                <td><?=$user[$i]['prenom']?></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><?=$user[$i]['nom']?></td>
            </tr>
            <?php
            if(isset($_POST[$i]))    
            {
                $delet_user = $_POST[$i];
                $delet_user = mysqli_query($conn,"DELETE FROM `utilisateurs` WHERE utilisateurs.id = '$delet_user'");
            }
            ?>
        </tbody>
    </table>
        <?php
   $i = $i + 1;
}
        ?>
    </section>
    </main>
 <footer>
     <?php
     require('footer.php');
     ?>
</footer>
</body>
</html>