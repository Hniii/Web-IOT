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
<body>
    <?php include "include/nav.php"?>
    <div class="container">
    <h4>Ajouter utilisateur</h4>
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
   
    <form method="post">
        <label for="">Login</label>
        <input type="text" name="login" required/>
        <label for="">Password</label>
        <input type="password" name="password" required/>
        <div id="passwordHelplock">
            Your password must be 8-20 characters long. contain letters and mumbers....
        </div>
        <input type="submit"  value="Ajouter utilisateur" name="ajouter"/>

    </form>
    </div>
   
</body>
</html>