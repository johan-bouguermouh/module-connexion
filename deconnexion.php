<?php
session_start();
if(isset($_SESSION['popup_annule']))
{
    unset($_SESSION['popup_annule']);
    header('location: profil.php');
}
else {
    session_destroy();
header('location: index.php');
}
?>