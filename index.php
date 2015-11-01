<?php 
include ("config/conexao.php");
$consulta = "SELECT * FROM user";
$con = $mysqli->query($consulta) or die($mysqli->error);

?>
<html>
<head>
    <title>comicbooks</title>
    <meta charset = "utf-8">
</head>
<body>
    página inicial
    <?php 
    while ($dado = $con->fetch_array()){
        echo $dado["email"];
        
    }
    
    ?>
    
</body>
</html>
