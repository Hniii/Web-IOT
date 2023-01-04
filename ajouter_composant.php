<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Ajouter catégorie</title>
</head>
<body>
    <?php
    require_once 'include/database.php';
    include "include/nav.php"?>
    <div class="container login">
    <h4>Ajouter composant </h4>
    <?php
        if(isset($_POST['ajouter'])){
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $etat = $_POST['etat'];
        $quantite = $_POST['quantite'];
        $categorie = $_POST['categorie'];
       // extract($_POST);//she create all the variables that she found in the $_POST but she have a prblm of security so we don't use it 
        $date = date(format:'Y-m-d');
        
         if (!empty($nom)&& !empty($quantite)&& !empty($etat)){
            $sqlState = $pdo->prepare(query: 'INSERT INTO composant VALUES (null,?,?,?,?,?,?)');
            $inserted =  $sqlState->execute([$nom, $description, $etat, $quantite, $date, $categorie]);
            if($inserted){
            ?>
            <div>Le composant <?php echo $nom ?> à été bien ajouter !</div>
            <?php
            }else{
                 
            ?>
            <div>Database erreur : Le composant <?php echo $nom ?> n'est pas  ajouté !</div>
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
        <label  for="">Nom</label>
        <input type="text" name="nom" />
       
        <label for="">Description</label>
        <textarea class="" name="description" ></textarea>
        
        <label for="">Etat</label>
        <select name="etat">
            <option value="disponible"> disponible </option>
            <option value="en panne"> En panne </option>
            <option value="perdu"> perdu </option>     
        </select>

        <label for="">Quantite</label>
        <input type="number" name="quantite" min="0" />
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
                echo " <option value=".$categorie['id'].">".$categorie['libelle']."</option>";
                }
             ?>
           
        </select>
        
        <input type="submit"  value="Ajouter composant" name="ajouter"/>

    </form>
    </div>
   
</body>
</html>