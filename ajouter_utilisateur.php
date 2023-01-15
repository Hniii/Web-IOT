<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>
<style>
     
     input[type="text"],
     input[type="email"],
     input[type="password"] {
         margin-left: 90px;
         padding: 0.5rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
     }   
     input[type="submit"]{
         margin-left: 120px;
         padding: 0.6rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         background: #0795f3e5;
         color: #fff;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
     }  
    
     label {
         margin-left: 90px;
         font-weight: bold;
     }
     .myform{
         display: block;
     }
     form{
     display: grid;
     gap: 32px;
     grid-template-columns: 1fr;
     margin: 0px auto;
     max-width: 396px;
     padding: 32px 16px;
     
     }
     h3{
         margin-left: 120px;
        color: #a8a6a6;
         
     }
    
 </style>
<body>
    <?php include "include/nav.php"?>
    <div class="container">
    <h2 class="title">Ajouter utilisateur</h2>
    <?php
    if (isset($_POST['ajouter'])) {
        $login = $_POST['login'];
        $pwd = $_POST['password'];

        if (!empty($login) && !empty($pwd)) {
           // Se connecter à la base de données:
            require_once 'include/database.php';
            $date = date(format: 'Y-m-d');
            $sqlState = $pdo->prepare(query: 'INSERT INTO utilisateur VALUES(null,?,?,?)');
            $sqlState->execute([$login,$pwd,$date]);
            //Redirection
            header(header: 'location: connexion.php');
        
        } else {
            ?>
           <div> Login, password sont obligatoires" </div>
        <?php
        }
    }
    ?>
   
    <form class="myform" method="post">
    <h4 >Veuillez attribuer un UserName et un Password</h4>
        <div>&nbsp;</div>
        <input type="text" placeholder="Nom d'utilisateur"name="login" required/>
        <div>&nbsp;</div>
        <input type="password" placeholder="Mot de passe"name="password" required/>
        <div>&nbsp;</div>
        <input type="submit"  value="Ajouter utilisateur" name="ajouter"/>

    </form>
    </div>
   
</body>
</html>