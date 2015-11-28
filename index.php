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
include "conteudo/obra.php";
do{
    $obras[]= new Obra ($linha['id'],$linha['titulo'],$linha['autor'],$linha['editora'],$linha['datal'],$linha['datap'],$linha['tipo'],$linha['pdf'],$linha['capa']);
    
}while($linha=$sql_query->fetch_assoc());
$quantidade=count($obras);
?>


<!doctype html>

<html>
<head>
    <title>comicbooks | home</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script>
    function Mudarestado(el) {
    var display = document.getElementById(el).style.display;
    if(display == "none")
        document.getElementById(el).style.display = 'block';
    else
        document.getElementById(el).style.display = 'none';
    }
    
    </script>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <!--aqui vai todo conteudo do planeta-->
            
            <?php
            foreach($obras as $obra){?>
                <article class="obra">
                    <table>
                        <tr><td rowspan="7"><img src="<?php echo $capap.$obra->capa; ?>"/></td><td>Título:<?php echo $obra->titulo; ?></td></tr>
                        <tr><td>Autor:<?php echo $obra->autor; ?></td></tr>
                        <tr><td>Editora:<?php echo $obra->editora; ?></td></tr>
                        <tr><td>Lançamento:<?php echo $obra->datal; ?></td></tr>
                        <tr><td>Postado:<?php echo $obra->datap; ?></td></tr>
                        <tr><td>Tipo:<?php echo $obra->tipo; ?></td></tr>
                        <tr><td><a href="<?php echo $pdfp.$obra->pdf; ?>" target="_blank">Abrir PDF</a>
                                <a onclick="Mudarestado('coment<?php echo $obra->id;?>')" >Comentarios</a>
                        </td></tr>
                        
                        
                    </table>
                    
                    <div id="coment<?php echo $obra->id;?>" style="display:none;">
                        oi
                    </div>
                </article>    
            <?php }while($linha=$sql_query->fetch_assoc());?>
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
