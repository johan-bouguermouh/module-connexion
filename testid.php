<?php
session_start();
if(!empty($_SESSION['prenom'] && !empty($_SESSION['nom'])))
{
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="testid.css">
    <title>Document</title>
</head>
<body>
    <div>
    <h3><?=$icon?></h3>
    </div>
</body>
</html>
<?php

}
?>