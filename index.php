<!doctype html>

<?php

include ("config/conexao.php");
//$mysqli = dbconnect ();
$consulta = "SELECT * FROM user";
$con = $mysqli->query($consulta) or die($mysqli->error);

?>
<html>
<head>
    <title>comicbooks | home</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id=main>
        <?php 
        include "conteudo/cadastrar.php";
        include "conteudo/footer.php";
        ?>
    </div>
</body>
</html>
