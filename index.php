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
        <title></title>
    </head>
    <body>
        <?php
            $query = "homme";
            $extract = new extractData;
            $result = $extract->getElement($query);
            
            echo "<pre>" . $result . "</pre>";
            //$result = $extract->extract($query);
            //$extract->writeContentInFile($query, $result);
        ?>
    </body>
</html>
