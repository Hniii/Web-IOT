<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2? family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Ajouter catégorie</title>
</head>
<style>
     
     input[type="text"],
     input[type="email"],
     input[type="password"],
     input[type="number"],
     input[type="file"],
     textarea,select{
         margin-left: 50px;
         margin: 10px;
         width: 300px;
         padding: 0.8rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }   
     input[type="submit"]{
         margin-left: 90px;
         margin-right: 60px;
         padding: 0.6rem;
         border-radius: 0.25rem;
         border: 1px solid #ced4da;
         background: #0795f3e5;
         color: #fff;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
       }  
    
     label {
         margin-left: 100 px;
         font-weight: bold;
     }
     .myform{
         display: block;
     }
     form{
     display: grid;
     gap: 40px;
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
        margin-left: 420px;
        padding: auto;
        color: #f89e9e;
     }
    </style>
<body>
    <?php
        require_once 'include/database.php';
        include "include/nav.php"
    ?>
    <div class="container login">
        <h2 class="title">Ajouter composant </h4>
        <?php
            if(isset($_POST['ajouter'])){
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $etat = $_POST['etat'];
            $quantite = $_POST['quantite'];
            $categorie = $_POST['categorie'];
            $img = $_POST['img'];
        // extract($_POST);//she create all the variables that she found in the $_POST but she have a prblm of security so we don't use it 
            $date = date(format:'Y-m-d');
            
            if (!empty($nom)&& !empty($quantite)&& !empty($etat)){
                $sqlState = $pdo->prepare(query: 'INSERT INTO composant VALUES (null,?,?,?,?,?,?,?)');
                $inserted =  $sqlState->execute([$nom, $description, $etat, $quantite, $date, $categorie,$img]);
                if($inserted){//If composant is well added to database without errors
                    header(header: 'location: composants.php');
        
                }else{//prblm while execution 
                    
                ?>
                     <span>Database erreur : Le composant <?php echo $nom ?> n'est pas  ajouté !</span>
                <?php

                }
            }else{
                ?>
                    <span>
                       ** Nom, quantité et l'état du composant sont obligatoires. **
                    </span>
                <?php
            }

            }

        ?>
        <form class="myform" method="post">
            <div class="popup">
            
                    <label  for="">Nom</label><br>
                    <input type="text" name="nom" /><br>
            </div>
            <div>&nbsp;</div>
            <label for="">Description</label><br>
            <textarea class="" name="description" ></textarea><br>
            <div>&nbsp;</div>
            <label for="">Etat</label><br>
            <select name="etat"><br>
                <option value="disponible"> Disponible </option>
                <option value="en panne"> En panne </option>
                <option value="perdu"> Perdu </option>     
            </select>
            <div>&nbsp;</div>
            <label for="">Quantite</label><br>
            <input type="number" name="quantite" min="0" /><br>
            <?php 
                // our query is secure no need to use "prepare" , instead we can just use "query"
                /* $sqlState = $pdo->query(query: 'SELECT * FROM categorie');
                $sqlState->execute();
                var_dump($sqlState->fetchAll());*/
                $categories = $pdo->query(query: 'SELECT * FROM categorie')->fetchAll(mode: PDO::FETCH_ASSOC);
                //print_r($categories);
                $composants = $pdo->query(query: 'SELECT * FROM composant')->fetchAll(mode: PDO::FETCH_ASSOC);
                
            ?>
            <div>&nbsp;</div>
            <label for="">Catégorie ou Type composant</label><br>
            <select name="categorie"><br>
                <option value=""> Choisissez une catégorie: </option><br>
                <?php
                    foreach ($categories as $categorie){
                    echo " <option value=".$categorie['id'].">".$categorie['libelle']."</option>";
                    }
                ?>
            
            </select>
            <div>&nbsp;</div>
            <label for="">Image</label><br>
            <select name="img"><br>
                <option value=""> Choisissez une image: </option>
                <?php
                    foreach ($composants as $composant){
                    echo " <option value=".$composant['id'].">".$composant['img']."</option>";
                    }
                ?>
            
            </select>
            <div>&nbsp;</div>
            <input type="submit"  value="Ajouter composant" name="ajouter"/><br>
        </form>
    </div>
   
</body>
</html>