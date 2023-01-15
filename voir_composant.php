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
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    <title>Liste des composants</title>
</head>
<body>
    <?php include "include/nav.php";
          include "include/database.php"?>
    <div class="container">
        <div> <h3 style="text-align: center; font-weight: blod;">COMPOSANTS</h3></div>
        <div>&nbsp;</div>
        <div class="dropdown">
            <button class="dropbtn">Actions</button>
            <div class="dropdown-content " id="export-menu">
                <a id="export-to-excel" href="#">Exporter Excel (.xlsx)</a>
                <a id="export-to-word" href="#">Génération d'une décharge (.docx)</a>
            </div>
        </div>
        <div>&nbsp;</div>
        <select name="fetch_date" id="fetch_date">
            <option value="">Sélectionner la date</option>
            <?php
                $query = "SELECT DISTINCT date FROM composant";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)){
                    echo '<option value="'.$row['date'].'">'.$row['date'].'</option>';
                }
            ?>
        </select>
        <div id="search_table"></div>
        <form method="post" action="generate_excel.php" id="export-form">
            <input type="hidden" name="hidden_type" id="hidden-type" />
        </form>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#export-to-excel").click(function(){
                    $("#hidden-type").val("excel");
                    $("#export-form").submit();
                });
                $("#export-to-word").click(function(){
                    $("#hidden-type").val("word");
                    $("#export-form").submit();
                });
                $("#fetch_date").change(function(){
                    var search = $(this).val();
                    if(search != ''){
                        $.ajax({
                            type: 'post',
                            url: 'generate_word.php',
                            data: {search:search},
                            success:function(data){
                                $("#search_table").html(data);
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</body>
</html>


