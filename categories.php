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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Liste des Categories</title>
</head>
<body>
    <?php include "include/nav.php"?>
    <div class="container">
        <h2>Liste des catégories:</h2>
        <a class="btn" href="ajouter_categorie.php">Ajouter catégorie</a>
        <table class="table" id="categories">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Opérations</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'include/database.php';
            $categories = $pdo->query( 'SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC); // we can just use query no prblm cause we don't need user data 
            
            foreach($categories as $categorie){
            ?>
                <tr>
                
                    <td><?php echo $categorie['id']?></td>
                    <td><?php echo $categorie['libelle']?></td>
                    <td><?php echo $categorie['description']?></td>
                    <td><?php echo $categorie['date_creation'];  
                    /*$d1 = new DateTime( date(format: "Y-m-d h:m:s"));
                    $d2 = new DateTime($categorie['date_creation']);
                    $interval = $d1->diff($d2);
                    echo $categorie['date_creation']->format('%d days, %H hours, %I minutes, %S seconds');  ?></td>*/
                    ?></td>
                    <td>
                   <!-- <button class="btn"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn"><i class="fa fa-trash"></i> Delete</button>
                   -->
                   <a href="modifier_categorie.php?id=<?php echo $categorie['id'] ?>" class="btn"><i class="fa fa-edit"></i></a>
                   <a href="supprimer_categorie.php?id=<?php echo $categorie['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer la categorie <?php echo $categorie['libelle'] ?>');""class="btn"><i class="fa fa-trash"></i></a>
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