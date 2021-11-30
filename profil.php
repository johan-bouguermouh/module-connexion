<?php
session_start();

// ** LANCEMENT DE MES VARIABLE POUR CSS */

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
//** RENVOYER PAGE INDEX SI NON CONNECTER */
if(empty($_SESSION['id']))
    {
    header('location: index.php');
    exit();
    }
else
    {
    $data_id = $_SESSION['id']; //Atribution d'une variable pour definir l'utilisateur cible
    }
//** CONNEXION A LA BASE DE DONNER */
$conn = mysqli_connect('localhost','root','','moduleconnexion');
$login = $_SESSION['login'];
//** CONDITION PRELIMINAIRE A L'UTILISATION DU FORMULAIRE */
    //** UPDATE PRENOM */
if(isset($_POST['m_prenom']))
{
    $prenom = $_POST['m_prenom'];
    $up_prenom = mysqli_query($conn,"UPDATE `utilisateurs` SET `prenom`= '$prenom' WHERE `id`='$data_id'");
    $_SESSION['prenom']=$prenom;
    $_SESSION['info_update'] ='Votre prénom a bien été modifier';
    header('location: profil.php');
    exit(); //L'exit est utile pour jouer mon gif de validation qui sera présent plus loin
}
    //** UPDATE NOM */
if(isset($_POST['m_nom']))
{
    $nom = $_POST['m_nom'];
    $up_prenom = mysqli_query($conn,"UPDATE `utilisateurs` SET `nom`= '$nom' WHERE `id`='$data_id'");
    $_SESSION['nom']=$nom;
    $_SESSION['info_update'] ='Votre nom a bien été modifier';
    header('location: profil.php');
    exit();
}
    //** UPDATE LOGIN */
if(isset($_POST['m_login']))
{
    $login = $_POST['m_login'];

    $select = mysqli_query($conn, "SELECT * FROM `utilisateurs` WHERE `login` = '$data_login'");
    $result_login = mysqli_fetch_all($select);
    if (count($result_login)!==0){
        echo 'le nom d\'utilisateur existe déjà';
    }
    else
    {
        $up_prenom = mysqli_query($conn,"UPDATE `utilisateurs` SET `login`= '$login' WHERE `id`='$data_id'");
    $_SESSION['login']=$login;
    $_SESSION['info_update'] = 'Votre login a bien été modifier';
    }
}
    //** UPDATE HTML*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
require('meta.php'); //Récupération des meta et des link necessaire à la navigation
?>
    <title>Mon compte</title>
</head>

<body class="<?=$id //Cette variable défini le comportement de mon css?>_body">
    <header>
        <?php
        require('header.php'); //Envoie de la barre de navigation 
        ?>
    </header>
    <main class="main_profil">
        <table>
            <?php
                if(isset($_SESSION['info_update'])) //Si la variable de session existe alors envoyer le message
                {
                    ?>      
                    <div class="info_update">
                        <img src="images\moodule_gif_validation.gif?date=<?php echo date('Y-m-d-H-i-s');?>" alt="validation"/>
                        <p><b><?=$_SESSION['info_update']?><b></p>
                    </div>
                    <?php
                unset($_SESSION['info_update']); //Supression de la variable de session après son jeux afin qu'elle ne s'affiche pas à chaque réactulaisation
                }
                
                elseif(isset($_SESSION['error_validation']))
                {
                ?>
                <div class="info_update">
                <img src="images\moodule_icon_error.png" alt="validation"/>
                <p><b><?=$_SESSION['error_validation']?></b><p>
                </div>
                <?php
                $localisation_erreur = 'error_user';
                unset($_SESSION['error_validation']);
                }
            ?>
            <thead>
                    <th><?=$_SESSION['prenom'].' '.$_SESSION['nom']?></th>
            </thead>
            <tbody>
                <tr>
                    <td>Prénom:</td>
                    <td>
    <?php
        //** SELECTION DE MODIFICATION PRENOM*/
    if(!isset($_POST['modif_prenom']))
    {
    ?>
                        <p><?=$_SESSION['prenom']?></p>
                    </td>
                    <td>
                        <form action="profil.php" method="post">
                        <input type="submit" name="modif_prenom" value="&#10000;">
                        </form>
                    </td>
    <?php
    }
    else
    //** FORMULAIRE DE MODIFICATION PRENOM*/
    {
    ?>
                            <form action="profil.php" method="post">
                            <input type="text" name="m_prenom" value="<?=$_SESSION['prenom']?>">
                    </td>
                    <td>
                            <input type="submit" name="modif_prenom" value="&#10004;">
                            </form>
                    </td>
    <?php
    }
    ?>
                </tr>
                <tr>
                    <td>Nom:</td>
                    <td>
    <?php
        //** SELECTION DE MODIFICATION NOM*/
        if(!isset($_POST['modif_nom']))
        {
            ?>
                                <p><?=$_SESSION['nom']?></p>
                            </td>
                            <td>
                                <form action="profil.php" method="post">
                                <input type="submit" name="modif_nom" value="&#10000;">
                                </form>
                            </td>
            <?php
            }
            else
        //** FORMULAIRE DE MODIFICATION NOM*/
            {
            ?>
                                    <form action="profil.php" method="post">
                                    <input type="text" name="m_nom" value="<?=$_SESSION['nom']?>">
                            </td>
                            <td>
                                    <input type="submit" name="modif_nom" value="&#10004;">
                                    </form>
                            </td>
            <?php
            }
            ?>
                </tr>
                <tr>
                    <td>Nom d'utilisateur:</td>
                    <td>
    <?php
    //** SELECTION DE MODIFICATION LOGIN*/
    if(!isset($_POST['modif_login']))
    {
        ?>
                            <p><?=$_SESSION['login']?></p>
                        </td>
                        <td>
                            <form action="profil.php" method="post">
                            <input type="submit" name="modif_login" value="&#10000;">
                            </form>
                        </td>
        <?php
        }
        else
    //** FORMULAIRE DE MODIFICATION LOGIN*/
        {
        ?>
                                <form action="profil.php" method="post">
                                <input type="text" name="m_login" value="<?=$_SESSION['login']?>">
                        </td>
                        <td>
                                <input type="submit" name="modif_login" value="&#10004;">
                                </form>
                        </td>
        <?php
        }
        ?>
<tr>
                    <td>Password:</td>
                    <td>
                    <?php
                    //** SELECTION DE MODIFICATION MDP*/
                    
                    if(!isset($_POST['modif_pass']))
                    {
                        echo '********';
                    ?>
                    </td>
                    <td>
                        <form action="profil.php" method="post">
                        <input type="submit" name="modif_pass" value="&#10000;">
                        
                        </form>
                    </td>
    <?php
    }
    elseif(empty($_POST['m_pass']))
    //** 1ER FORMULAIRE DE MODIFICATION LOGIN - VERIFICATION DE L'ANCIEN MDP*/
    {
    ?>
                            <form action="profil.php" method="post">
                                <input type="text" name="m_pass" placeholder="Ancien Mot de passe">
                            </td>
                            <td>
                                <input type="submit" name="modif_pass" value="&#10004;"><br>
                                </form>
                            </td>       
    <?php
    }
    ?>
                </tr>
            </tbody>
        </table> 
    <?php
    //**FIN DE MON TABLEAU POUR LES MODIFICATION & ENTREE DANS LA FENETRE POPUP */
    if((isset($_POST['m_pass'])) || isset($_POST['Modification_mdp'])) //Début des condition de mon formulaire se trouvant en bas de la pages
    {
        if(isset($_POST['m_pass'])){
                        $password = $_POST['m_pass'];
                        $m_vmdp = mysqli_query($conn,"SELECT * FROM utilisateurs WHERE`id`= '$data_id'");
                        $vmdp2 = mysqli_fetch_assoc($m_vmdp);
                        $vmdp3 = $vmdp2['password'];

        }

        if(empty($_POST['new_pass'])&&empty($_POST['new_passv']))
            {
                $_SESSION['error_mdp'] ='Remplir les champs';
            }            
        elseif(!empty($_POST['new_pass']))
        {
                        if(($_POST['new_pass']===$_POST['new_passv']))
                        {
                            $new_password = $_POST['new_pass'];
                            $new_mdp_secure = password_hash($new_password,PASSWORD_BCRYPT);
                            $up_password = mysqli_query($conn,"UPDATE `utilisateurs` SET `password`= '$new_mdp_secure' WHERE `id`='$data_id'");
                            unset($_POST['Modification_mdp']);
                            $_SESSION['info_update'] = 'Votre mot de passe a bien été modifier';
                            $_SESSION['final']=1;
                        }
                        else
                        {
                            $_SESSION['error_mdp'] = 'Assurez vous que les mots de passes soit identiques';
                        }
        }
        if(isset($_POST['m_pass']) && (password_verify($password,$vmdp3) === TRUE) Or isset($_POST['Modification_mdp']))
        { 
            $_SESSION['popup_annule']='on';

            ?>
            <section id="popup_password">
                <div class="popup_password_content">
                    <p><b>Vous êtes sur le point de modifier votre mot de passe.</b></p>
                    <p><b><?=$_SESSION['error_mdp']?></b></p>
                <form action="profil.php" method="post">
                    <label for="new_pass">Rentrer votre nouveau mot de pass</label>
                    <input type="text" name="new_pass" placeholder="Nouveau mot de passe"><br>
                    <label for="new_passv">Récrivez votre nouveau mot de pass </label>
                    <input type="text" name="new_passv" placeholder="Verfier le nouveau mot de passe"><br>
                    <div id="input_bottom">
                        <a href="deconnexion.php">annuler</a>
                        <input type="submit" name='Modification_mdp' value="modifier">
                    </div>                            
    <?php
        }
        else
        {
            $_SESSION['error']=1;
            $_SESSION['error_validation']='Mot de passe incorrect';
        }  
    }
    if(isset($_SESSION['final']) && $_SESSION['final']==1)
{
    unset($_SESSION['error']);
    unset($_SESSION['popup_annule']);
    unset($_SESSION['final']);
    unset($_SESSION['error_validation']);
    header('location: profil.php');
    exit();
}
    elseif(isset($_SESSION['error']) && $_SESSION['error']==1){
        unset($_POST);
        unset($_SESSION['error']);
        header('location: profil.php');
        exit();
    }
                    ?>
                            </div>
                        </section>
    </main>
        <footer>
        <?php
    require('footer.php');
    ?>
        </footer>
</body>
</html>