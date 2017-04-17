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
         $navn = $_REQUEST["navn"];
         $tlf = $_REQUEST["tlf"];
         $adresse = $_REQUEST["adresse"];
         $epost = $_REQUEST["epost"];
         echo $navn.", ".$tlf.", ".$adresse.", ".$epost;
        ?>
    </body>
</html>
