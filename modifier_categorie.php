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
    <title>Modifier catégorie</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container login">
    <h4> Modifier catégorie </h4>
    <?php
        require_once 'include/database.php';
        $sqlState = $pdo->prepare(query: 'SELECT * FROM categorie WHERE id=? ');
        $id = $_GET['id'];
        $sqlState->execute([$id]);

        $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
         if(isset($_POST['modifier'])){
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
    
            if(!empty($libelle)&& !empty($description)){
                $sqlState = $pdo->prepare(query: 'UPDATE categorie
                                                  SET
                                                 libelle=?,
                                                 description=?
                                                 WHERE id=?
                                                 ');
                $sqlState->execute([$libelle, $description,$id]);
                
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
        <label  for="">ID</label>
        <input type="text" name="id" value="<?php echo $categorie['id']?>"/>

        <label  for="">Libelle</label>
        <input type="text" name="libelle"  value="<?php echo $categorie['libelle']?>" />

        <label for="">Description</label>
        <textarea class="" name="description" ><?php echo $categorie['description']?></textarea>
        
        <input class="btn" type="submit"  value="Modifier categorie" name="modifier"/>

    </form>
    </div>
   
</body>
</html>