<?php 
    include('include/database.php');
    //Get the search value from the post data
    $ExportType = $_POST['ExportType'];


   // $composants = $pdo->query( "SELECT * FROM composant WHERE etat like '%$search%' or date like '%$search%'")->fetchAll(PDO::FETCH_OBJ); // we can just use query no prblm cause we don't need user data 
   $composants = $pdo->query( "SELECT composant.id as 'ID',composant.nom as 'Nom',composant.etat as 'Etat',composant.quantite as 'Quantité disponible',composant.date as 'Date', categorie.libelle as 'catégorie' FROM composant INNER JOIN categorie ON composant.id_categorie=categorie.id")->fetchAll(PDO::FETCH_ASSOC); // we can just use query no prblm cause we don't need user data 
    // we can just use query no prblm cause we don't need user data 
    if (isset($ExportType)){
        switch($ExportType){
        case "export-to-word":
            $filename = "phpflow_data_export_" . date('Ymd') . ".docx";
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachement; filename=\"$filename\"");
            ExportFileW($composants);
            exit();
        case "export-to-excel":
                $filename = "phpflow_data_export_" . date('Ymd') . ".xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachement; filename=\"$filename\"");
                ExportFile($composants);
                exit();
        default:
                die("Unknown action:" . $_POST["action"]);
                break;

        }
    } 
    function ExportFileW($records){
        $heading=false;
        if(!empty($records)){
            foreach($records as $row){
                if(!$heading){
                     echo implode("\t ", array_keys($row))."\n";
                    $heading = true;

                }
                echo implode("\t", array_values($row))."\n";
                
            }
        }
    }


    function ExportFile($records){
        $heading=false;
        if(!empty($records)){
            foreach($records as $row){
                if(!$heading){
                    echo implode("\t", array_keys($row))."\n";
                    $heading = true;

                }
                echo implode("\t", array_values($row))."\n";
                
            }
        }
    }

