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
    <title>Ajouter catégorie</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container login">
    <h4> Ajouter catégorie </h4>
    <?php
      if (isset($_POST['ajouter'])){
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];

        if(!empty($libelle)&& !empty($description)){
            require_once 'include/database.php';
            $sqlState = $pdo->prepare(query: 'INSERT INTO categorie (libelle,description) VALUES(?,?)');
            $sqlState->execute([$libelle, $description]);
            header(header: 'location: categories.php');
        }else{
           ?>
           <div>
            libelle, description sont obligatoires
           </div>
           <?php 
        }
      }
    ?>
    <form method="post">
        <label  for="">Libelle</label>
        <input type="text" name="libelle" />

        <label for="">Description</label>
        <textarea class="" name="description" ></textarea>
        
        <input class="btn" type="submit"  value="Ajouter categorie" name="ajouter"/>

    </form>
    </div>
   
</body>
</html>