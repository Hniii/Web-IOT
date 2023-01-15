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
<style>
     
     input[type="text"],
     input[type="email"],
     input[type="password"] , textarea{
         margin-left: 40px;
         margin-right: 40px;
         padding: 0.6rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
     }   
     input[type="submit"]{
         margin-left: 60px;
         margin-right: 60px;
         padding: 0.6rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         background: #0795f3e5;
         color: #fff;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
     }  
    
     label {
        
         font-weight: bold;
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
    span{
        margin-left: 480px;
        padding: auto;
        color: #f89e9e;
     }
    </style>
<body>
    <?php include "include/nav.php"?>
    <div class="container login">
    <h2 class="title"> Modifier catégorie </h2>
    <?php
        require_once 'include/database.php';
        $sqlState = $pdo->prepare(query: 'SELECT * FROM categorie WHERE id=? ');
        $id = $_GET['id'];
        $sqlState->execute([$id]);

        $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
         if(isset($_POST['modifier'])){
            $id_ = $_POST['id'];
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
    
            if(!empty($libelle)&& !empty($description)){
                $sqlState = $pdo->prepare(query: 'UPDATE categorie
                                                  SET
                                                 id=?,
                                                 libelle=?,
                                                 description=?
                                                 WHERE id=?
                                                 ');
                $sqlState->execute([$id_,$libelle, $description,$id]);
                
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
   
    <form class="myform" method="post">
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