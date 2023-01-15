<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/style.css">
    <link rel="stylesheet" href="include/css/jquery-ui.css">
    <script type="text/javascript" src="include/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="include/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <!-- jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- PHPExcel library -->
    <title>Liste des composants</title>
    </head>
    <style>
.dropbtn {
  background-color:#6495b6;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #4CAF50;
}

</style>

<body>
    <?php include "include/nav.php";
     require_once 'include/database.php';?>
    <div class="container">
        <div> <h3 class="title">COMPOSANTS</h3></div>
        <div class="row">
            <div class="col">
                <a class="btn" href="ajouter_composant.php">Ajouter composant</a>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col">
                <label>Appliquer un filtre par:</label>
                <div>&nbsp;</div>
                <div>
                    <label>Etat:</label>
                    <select name="fetchetat" onChange="
                        fetch_etat()" id="fetch_etat">
                        <option value="">Etat</option>
                        <option value="disponible"> Disponible </option>
                        <option value="en panne"> En panne </option>
                        <option value="perdu"> Perdu </option>     
                    </select>
                </div>
                <div>&nbsp;</div>
                <div>
                    <label>Date:</label>
                    <input type="date" name="fetch_date" id="fetch_date" onChange="
                    fetch_date()">
                </div>
                <div>&nbsp;</div>
            </div><!--col-->
            <div class="col">
                <div> <i class="fa fa-search"></i>
                    <input type="text" name="search" id="search" placeholder="Search..." onkeyup="
                    search_data()">
                </div>
                <div>&nbsp;</div>
            </div><!--col-->
            <div class="col">
                            
                <div class="dropdown">
                    <button class="dropbtn">Actions</button>
                    <div class="dropdown-content " id="export-menu">
                    <a id="export-to-excel" href="#"> Génération d'un Excel  (.xls)</a>
                    <a id="export-to-word" href="#">Génération d'une décharge (.docx)</a>
                </div>       
                <form action="generate_file.php" method="post" id="export-form">
                    <input type="hidden" value='' id="hidden-type" name="ExportType"/>
                </form>
            </div><!--col-->
            <div>&nbsp;</div>   
            </div><!--col-->
         </div><!--row-->
          
         <div id="search_table">
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
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 

            //To be able to put the name of the categorie instead it Id we join the two tables to get the categorie name for  each component
            $composants = $pdo->query( "SELECT composant.*, categorie.libelle as 'categorie_libelle' FROM composant INNER JOIN categorie ON composant.id_categorie=categorie.id")->fetchAll(PDO::FETCH_OBJ); // we can just use query no prblm cause we don't need user data 
            foreach($composants as $composant){
            ?>
                <tr>
                    <td><?= $composant->id?></td>
                    <td><?= $composant->nom?></td>
                    <td><?= $composant->description?></td>
                    <td><?= $composant->etat ?></td> 
                    <td><?= $composant->quantite?></td>
                    <td><?= $composant->date?></td>
                    <td><?= $composant->categorie_libelle?></td>
                    <td><img class="imgstyle responsive" src="images/<?= $composant->img?>"></td>
                    <td>
                        <a href="modifier_composant.php?id=<?php echo $composant->id ?>"
                         style="display:inline-block; color: #01c097; font-size:30px; padding:5px;margin-left:5px; margin-top:5px;">
                         <i class="fa fa-edit"></i>
                        </a>
                        <a href="supprimer_composant.php?id=<?php echo $composant->id ?>"
                           onclick="return confirm('Voulez vous vraiment supprimer le composant
                           <?php echo $composant->nom ?>');"
                            style="display:inline-block; color:#f18181; font-size:30px;padding:5px;">
                           <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>
        </div>
    </div>
   
</body>
</html>
<style>
    #loading{
        text-align: center;
        background: url('/images/icons/loader.gif') no-repeat center;
        height:150px;
    }
</style>
<script>
function search_data(){
    var search=jQuery('#search').val();
    if(search != ''){
        jQuery.ajax({
            type:'post',
            url: 'getData.php',
            data: 'search='+ search,
            success:function(data){
                jQuery('#search_table').html(data);
            }
        });
    }
}

function fetch_etat(){
    var search=jQuery('#fetch_etat').val();
    if(search != ''){
        jQuery.ajax({
            type:'post',
            url: 'fetch_etat.php',
            data: 'search='+ search,
            success:function(data){
                jQuery('#search_table').html(data);
            }
        });
    }
}

function fetch_date(){
    var search=jQuery('#fetch_date').val();
    if(search != ''){
        jQuery.ajax({
            type:'post',
            url: 'fetch_date.php',
            data: 'search='+ search,
            success:function(data){
                jQuery('#search_table').html(data);
            }
        });
    }

}

$(document).ready(function(){

jQuery("#export-to-word").bind("click",function(){
     var  target = $(this).attr('id');
     switch(target){
         case 'export-to-word':
             $('#hidden-type').val(target);
             $('#export-form').submit();
             $('#hidden-type').val('');
             break;
        
     }

 });

});

$(document).ready(function(){

jQuery("#export-to-excel").bind("click",function(){
     var  target = $(this).attr('id');
     switch(target){
         case 'export-to-excel':
             $('#hidden-type').val(target);
             $('#export-form').submit();
             $('#hidden-type').val('');
             break;
     }
     
 });
});
</script>

