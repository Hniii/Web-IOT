<?php
require 'PHPWord/vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

if(isset($_POST["hidden_type"])){
    $search = '';
    if(isset($_POST["search"])){
        $search = $_POST["search"];
    }
    $type = $_POST["hidden_type"];

    if($type == 'excel'){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=composants.xls");
        $query = "SELECT * FROM composant WHERE date = '$search'";
        $result = mysqli_query($conn, $query);
        echo '<table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Etat</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
            echo '
                <tr>
                    <td>'.$row["id"].'</td>
                    <td>'.$row["nom"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                    <td>'.$row["etat"].'</td>
                </tr>';
        }
        echo '</table>';
    }else if($type == 'word'){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=composants.doc");
        $query = "SELECT * FROM composant WHERE date = '$search'";
        $result = mysqli_query($conn, $query);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addText("ID");
        $table->addCell(2000)->addText("Nom");
        $table->addCell(2000)->addText("Type");
        $table->addCell(2000)->addText("Date");
        $table->addCell(2000)->addText("Etat");
        while($row = mysqli_fetch_array($result)){
            $table->addRow();
            $table->addCell(2000)->addText($row["id"]);
            $table->addCell(2000)->addText($row["nom"]);
            $table->addCell(2000)->addText($row["type"]);
            $table->addCell(2000)->addText($row["date"]);
            $table->addCell(2000)->addText($row["etat"]);
        }
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }
}
