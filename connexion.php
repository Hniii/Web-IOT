<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="include/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Connexion</title>
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
        margin-left: 135px;
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
    <?php
       if(isset($_POST['connexion'])){
        $login = $_POST['login'];
        $pwd   = $_POST['password'];

        if(!empty($login) && !empty($pwd) ){
            require_once 'include/database.php';
            $sqlState = $pdo->prepare(query: 'SELECT * FROM utilisateur
                                            WHERE login=?
                                            AND password=?');
            $sqlState->execute(([$login, $pwd]));
            if($sqlState->rowCount()){
                //utilisateur valide j'ouvre une session to hide data
                //session_start(); we put it in the nav.php 
                $_SESSION['utilisateur'] = $sqlState->fetch();
                header(header: 'location: admin.php');
              
            }else{
                ?>
                 <div>
                    Login ou password incorrectes !
                 </div>
                <?php
            }
        }else{
            ?>
            <div>
                Login, password sont obligatoires !
            </div>
            <?php
        }
       }
    ?>

    <h2 class="title">Connexion</h2>
    <form  class="myform" method="post">
        
        <h3 >-- Welcome --</h3>
        <div>&nbsp;</div>
        <input type="text" placeholder="Nom d'utilisateur"name="login" required/>
        <div>&nbsp;</div>
        <input type="password" placeholder="Mot de passe"name="password" required/>
        <div>&nbsp;</div>
        <input type="submit"  value="Connexion" name="connexion"/>
        
    </form>

    </div>
   
</body>
</html>