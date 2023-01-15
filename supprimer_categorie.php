<?php
    //var_dump($_GET); to see that we sended the id of cat that we want to delete 
    require_once 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query:'DELETE FROM categorie WHERE id=?');
    $supprime = $sqlState->execute([$id]);
    if ($supprime) { //tester la supression correcte
           header(header:'location: categories.php');    
    }else{
    echo "Database error";
    }

?>