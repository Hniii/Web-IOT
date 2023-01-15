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
    <title>Connexion</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container login">
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
    <h4>Connexion</h4>
    <form method="post">
        <label for="">Login</label>
        <input type="text" name="login" required/>
        <label for="">Password</label>
        <input type="password" name="password" required/>
        <div id="passwordHelplock">
            Your password must be 8-20 characters long. contain letters and mumbers....
        </div>
        <input type="submit"  value="Connexion" name="connexion"/>
        
    </form>
    </div>
   
</body>
</html>