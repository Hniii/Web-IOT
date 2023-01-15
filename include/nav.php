<?php 
    session_start(); //we put it in the nav.php so then I can use it easily in both connexion and admin or others
    $connecte = false;
    if(isset($_SESSION['utilisateur'])){
    $connecte = true;
    }
?>
<div class="navbar">
    <div class="logo">
        <img src="images/icons/logo.png" width="80px">            </div>
            <nav>
                <ul>
                 
                                      
                    <?php 
                        if($connecte){
                            ?>
                            
                            <li><a href="categories.php" >Liste  des categories</a></li>
                            <li><a href="composants.php" >Liste  des composants</a></li>
                            <li><a href="ajouter_categorie.php">Ajouter categorie</a></li>                        
                            <li><a href="ajouter_composant.php">Ajouter composant</a></li>
                            <li><a href="ajouter_utilisateur.php">Ajouter Utilisateur</a></li>   
                            <li><a href="deconnexion.php">Déconnexion</a></li>
                            
                            <?php 
                        }else{
                            ?>
                            <li><a href="connexion.php">Connexion</a></li>
                            <li><a href="index.php" >Acceuil</a></li>
                            <?php

                        }
                    ?>
                   
                </ul>
            </nav>
        <img src="images/icons/menu.png" class="menu-icon">

</div>