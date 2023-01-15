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
    <div class="container ">
    <h2 class="title"> Ajouter catégorie </h2>
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
           <span>
            *** Libelle, description sont obligatoires ***
        </span>
           <?php 
        }
      }
    ?>
    <form class="myform" method="post">
        <label  for="">Libelle</label>
        <input type="text" name="libelle" />
     
        <label for="">Description</label>
        <textarea class="" name="description" ></textarea>
    
        <input  type="submit"  value="Ajouter categorie" name="ajouter"/>

    </form>
    </div>
   
</body>
</html>