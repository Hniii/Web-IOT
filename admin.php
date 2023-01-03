<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container login">
    <?php
     //session_start(); we put it in the nav.php 
    //ila makanch hada utilisateur 
    if(!isset($_SESSION['utilisateur'])){
        header(header: 'location: connexion.php');
    }
        
    ?>

    <h3>Bonjour <?php echo $_SESSION['utilisateur']['login']?></h3>

    
    </div>
   
</body>
</html>