<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2? family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Modifier composant</title>
</head>

<body>
    <?php
        require_once 'include/database.php';
        include "include/nav.php";
        $sqlState = $pdo->prepare(query: 'SELECT * FROM composant WHERE id=? ');
        $id = $_GET['id'];
        $sqlState->execute([$id]);
        $composant = $sqlState->fetch(PDO::FETCH_OBJ);


    ?>
    <div class="container login">
        <h4>Modifier composant </h4>
        <?php
            if(isset($_POST['modifier'])){
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $etat = $_POST['etat'];
            $quantite = $_POST['quantite'];
            $categorie = $_POST['categorie'];
            $img = $_POST['img'];
            
            if (!empty($nom)&& !empty($quantite)&& !empty($etat)){
                $sqlState = $pdo->prepare(query: 'UPDATE composant
                SET 
                nom=?,
                description=?,
                etat=?,
                quantite=?,
                id_categorie=?,
                img=?
                WHERE id=?');
                $updated=  $sqlState->execute([$nom, $description, $etat, $quantite, $categorie,$img,$id]);
                if($updated){//If composant is well added to database without errors
                    header(header: 'location: composants.php');
        
                }else{//prblm while execution 
                    
                ?>
                     <div>Database erreur : Le composant <?php echo $nom ?> n'est pas  modifié !</div>
                <?php

                }
            }else{
                ?>
                    <div>
                    Nom, quantité et l'état du composant sont obligatoires.
                    </div>
                <?php
            }

            }

        ?>
        <form method="post">
             <input type="hidden" name="id" value="<?php echo $composant->id ?>"/>
        


            <label  for="">Nom</label>
            <input type="text" name="nom" value="<?php echo $composant->nom ?>" />
        
            <label for="">Description</label>
            <textarea class="" name="description" ><?php echo $composant->description ?></textarea>
            
            <label for="">Etat</label>
            <select name="etat">
                <option  value="<?php echo $composant->etat?>"><?php echo $composant->etat?> </option>
               
                <option value="disponible"> Disponible </option>
                <option value="en panne"> En panne </option>
                <option value="perdu"> Perdu </option>     
            </select>

            <label for="">Quantite</label>
            <input type="number" name="quantite" min="0"value="<?php echo $composant->quantite?>"></input>
            <?php 
                // our query is secure no need to use "prepare" , instead we can just use "query"
                /* $sqlState = $pdo->query(query: 'SELECT * FROM categorie');
                $sqlState->execute();
                var_dump($sqlState->fetchAll());*/
                $categories = $pdo->query(query: 'SELECT * FROM categorie')->fetchAll(mode: PDO::FETCH_ASSOC);
                //print_r($categories);
            ?>
            <label for="">Catégorie ou Type composant</label>
            <select name="categorie">
                <option value=""> Choisissez une catégorie: </option>
                <?php
                    foreach ($categories as $categorie){
                        $selected = $composant->id_categorie ==$categorie['id']?'selected':'';
                        
                        echo " <option $selected value=".$categorie['id'].">".$categorie['libelle']."</option>";
                    }
                ?>
            
            </select>
            <label for="">Image</label>
            <input type="file" id="img" name="img">
            
            <input type="submit"  value="Modifier composant" name="modifier"/>
        </form>
    </div>
   
</body>
</html>