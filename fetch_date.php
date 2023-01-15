<?php
    include('include/database.php');

    $search=$_POST['search'];
   // $composants = $pdo->query( "SELECT * FROM composant WHERE etat like '%$search%' or date like '%$search%'")->fetchAll(PDO::FETCH_OBJ); // we can just use query no prblm cause we don't need user data 
   $composants = $pdo->query( "SELECT composant.*, categorie.libelle as 'categorie_libelle' FROM composant INNER JOIN categorie ON composant.id_categorie=categorie.id WHERE date like '%$search%'")->fetchAll(PDO::FETCH_OBJ); // we can just use query no prblm cause we don't need user data 
    // we can just use query no prblm cause we don't need user data 
    if (isset($composants)){
       ?>    <table class="table" id="composants">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Etat</th>
                <th>Quantite</th>
                <th>Date</th>
                <th>Catégorie</th>
                <th>Image</th>
            </tr>
        </thead> 
        <?php
        foreach($composants as $composant){
        ?>  <tr>
        <td><?= $composant->id?></td>
        <td><?= $composant->nom?></td>
        <td><?= $composant->description?></td>
        <td><?= $composant->etat ?></td> 
        <td><?= $composant->quantite?></td>
        <td><?= $composant->date?></td>
        <td><?= $composant->categorie_libelle?></td>
        <td><img class="imgstyle responsive" src="images/<?= $composant->img?>"></td>
    </tr>
   <?php 
        }?>
        </table>
    <?php
    }else{
        echo "Data not found";
    }
?>