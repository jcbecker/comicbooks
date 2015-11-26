<?php
include ("config/conexao.php");
$sql_code = "SELECT * FROM obra";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
if ($sql_query){
    $flag="sucesso";
}else{
    $flag="erro ao conectar ao banco de dados";
}
$linha=$sql_query->fetch_assoc();
$capap="upload/obra/capa/";
$pdfp="upload/obra/pdf/";

?>


<!doctype html>

<html>
<head>
    <title>comicbooks | home</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <!--aqui vai todo conteudo do planeta-->
            
            <?php 
            do{?>
                <article class="obra">
                    <table>
                        <tr><td rowspan="7"><img src="<?php echo $capap.$linha['capa']; ?>"/></td><td>Titulo:<?php echo $linha['titulo']; ?></td></tr>
                        <tr><td>Autor:<?php echo $linha['autor']; ?></td></tr>
                        <tr><td>Editora:<?php echo $linha['editora']; ?></td></tr>
                        <tr><td>Lançamento:<?php echo $linha['datal']; ?></td></tr>
                        <tr><td>Postado:<?php echo $linha['datap']; ?></td></tr>
                        <tr><td>Tipo:<?php echo $linha['tipo']; ?></td></tr>
                        <tr><td><a href="<?php echo $pdfp.$linha['pdf']; ?>" target="_blank">Abrir PDF</a></td></tr>
                        
                        
                    </table>
                    
                </article>    
            <?php }while($linha=$sql_query->fetch_assoc());?>
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
