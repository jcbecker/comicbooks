<!doctype html>

<?php

include ("config/conexao.php");
//$mysqli = dbconnect ();
$consulta = "SELECT * FROM user";
$con = $mysqli->query($consulta) or die($mysqli->error);


$texto="malu hayaçsodkçalsdkaçsldk";
$meuconteudo="cadastrar.php";
?>
<html>
<head>
    <title>comicbooks | home</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</script>
</head>
<body>
    <div id="main">
        <?php 
        include_once "conteudo/header.php";
        
        include_once "conteudo/content.php";
        
        include_once "conteudo/footer.php";
        ?>
    </div>
</body>
</html>
