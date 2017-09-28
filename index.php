<?php 
ini_set('display_errors', 'On');
require_once 'extractData.php';

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php 
            if (isset($_GET["search"]))
                echo($_GET["search"]);
            else
                echo("Recherche du mot") ?>
        </title>       
        <style>
            body{
                margin:50px 50px;
            }
            form{
                display:flex;
                justify-content: center;
            }
            form input[type="text"]{
                width: 1000px;
                height: 27px;
                margin-right: 10px;
            }
            
            form input[type="submit"]{
                background-color: rgb(100,200,100);
                color:white;
                font-weight: bold;
                border: none;
            }
        </style>
    </head>
    <body>
        <form action="index.php" method="get">
            <input type="text" name="search" placeholder="Entrez le mot à rechercher" id="search"/>
            <input type="submit" value="Rechercher"/>
        </form>
        
        <?php
        
            if(isset($_GET["search"]) && strcmp($_GET["search"],"")!== 0){
                $query = $_GET["search"];
                $extract = new extractData;
                $result = $extract->getElement($query);

                echo "<pre>" . $result . "</pre>";
            }
        ?>
    </body>
</html>
