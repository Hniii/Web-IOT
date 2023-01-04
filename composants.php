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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Liste des composants</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container">
        <h2>Liste des composants:</h2>
        <a class="btn" href="ajouter_composant.php">Ajouter composant</a>
        <table class="table" id="composants">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Etat</th>
                    <th>Quantite</th>
                    <th>Date</th>
                    <th>Catégorie</th>
                    <th>Opérations</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'include/database.php';
            //To be able to put the name of the categorie instead it Id we join the two tables to get the categorie name for  each component
            $composants = $pdo->query( "SELECT composant.*, categorie.libelle as 'categorie_libelle' FROM composant INNER JOIN categorie ON composant.id_categorie=categorie.id")->fetchAll(PDO::FETCH_ASSOC); // we can just use query no prblm cause we don't need user data 
            
            foreach($composants as $composant){
            ?>
                <tr>
                    <td><?= $composant['id']?></td>
                    <td><?= $composant['nom']?></td>
                    <td><?= $composant['description']?></td>
                    <td><?= $composant['etat']?></td> 
                    <td><?= $composant['quantite']?></td>
                    <td><?= $composant['date']?></td>
                    <td><?= $composant['categorie_libelle']?></td>
                    <td>
                    <button class="btn"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>

    </div>
   
</body>
</html>