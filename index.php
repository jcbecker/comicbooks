<!doctype html>
<?php 
include ("config/conexao.php");
//$mysqli = dbconnect ();
$consulta = "SELECT * FROM user";
$con = $mysqli->query($consulta) or die($mysqli->error);

?>
<html>
<head>
    <title>comicbooks</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div class=principal>
        página inicial
        <?php 
        while ($dado = $con->fetch_array()){
            echo $dado["email"];
            
        }
        include "conteudo/cadastrar.php";
        ?>
    </div>
</body>
</html>
