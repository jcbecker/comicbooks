<?php
include_once "protect.php";
include ("config/conexao.php");
$sql_code = "SELECT * FROM obra ORDER BY datap desc";
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

include "conteudo/comentario.php";
foreach($obras as $obra){
    $sql_code = "SELECT * FROM ocomentario WHERE obra='$obra->id' ORDER BY horario asc";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha=$sql_query->fetch_assoc();
    do{
        $comment[]= new Comentario($linha['user'],$linha['obra'],$linha['horario'],$linha['texto']);
        
    }while($linha=$sql_query->fetch_assoc());
    
    
    
}


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
    
    function contarCaracteres(box,valor,campospan,myself){
	    var conta = valor - box.length;
	    document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + " caracteres";
	    if(box.length >= valor){
		    document.getElementById(campospan).innerHTML = "Opss.. você não pode mais digitar..";
		    document.getElementById(myself).value = document.getElementById(myself).value.substr(0,valor);
	    }	
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
                    
                    <div id="coment<?php echo $obra->id;?>" style="display:none;" class="comentario">
                        <?php foreach($comment as $comentario){
                            if($comentario->obra==$obra->id){
                                echo "$comentario->user</br>";
                                echo "$comentario->texto</br>";
                                echo "$comentario->horario</br>";
                            }
                        }
                        
                        if (talogado()){ ?>
                            <form>
                                <ul class="form-style-1">
                                    <li>
                                        <textarea cols="45" id="campo<?php echo $obra->id;?>" rows="5" onkeyup="contarCaracteres(this.value,140,'sprestante<?php echo $obra->id;?>','campo<?php echo $obra->id;?>')"></textarea>
                                    </li>
                                    <li><span id="sprestante<?php echo $obra->id;?>" style="font-family:Georgia;"></span></li>
                                    <li>
                                        <input type="submit" value="comentar" name="enviacomentario">
                                    </li>
                                </ul>
                            </form>
                        <?php }else{
                            echo "você precisa estar logado para comentar";
                        }?>
                    </div>
                </article>    
            <?php }?>
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
