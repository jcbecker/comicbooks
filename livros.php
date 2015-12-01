<?php
include_once "protect.php";
include ("config/conexao.php");

if (isset($_POST['enviacomentario'])){
    $sql_code = "INSERT INTO ocomentario (user, obra, horario, texto)
    VALUES ('$_POST[iduser]','$_POST[idobra]',NOW(),'$_POST[texto]')";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    if (!$sql_query){
        $flag=false;
    }
    
}



$sql_code = "SELECT * FROM obra WHERE tipo='livro' ORDER BY datap desc";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
if ($sql_query){
//    $flag="sucesso";
}else{
    $flag=false;
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
    $sql_code = "SELECT nome, obra, horario, texto  FROM ocomentario JOIN user ON id=user WHERE obra='$obra->id' ORDER BY horario asc";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    if (!$sql_query){
        $flag=false;
    }
    $linha=$sql_query->fetch_assoc();
    do{
        $comment[]= new Comentario($linha['nome'],$linha['obra'],$linha['horario'],$linha['texto']);
        
    }while($linha=$sql_query->fetch_assoc());
    
    
    
}


?>


<!doctype html>

<html lang="pt-br">
<head>
    <title>comicbooks | Livros</title>
    <meta charset = "utf-8"/>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script language="JavaScript" src="js/fjs.js"></script>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <h1>Ultimos Livros postadas</h1>
            <!--aqui vai todo conteudo do planeta-->
            
            <?php
            foreach($obras as $obra){?>
                <article class="obra">
                    <table>
                        <tr><td rowspan="6"><img src="<?php echo $capap.$obra->capa; ?>"/></td><td>Título:<?php echo $obra->titulo; ?></td></tr>
                        <tr><td>Autor:<?php echo $obra->autor; ?></td></tr>
                        <tr><td>Editora:<?php echo $obra->editora; ?></td></tr>
                        <tr><td>Lançamento:<?php echo $obra->datal; ?></td></tr>
                        <tr><td><?php echo $obra->datap; ?></td></tr>
                        
                        <tr><td><a href="<?php echo $pdfp.$obra->pdf; ?>" target="_blank">Abrir PDF</a>
                                <a onclick="Mudarestado('coment<?php echo $obra->id;?>')" >Comentarios</a>
                        </td></tr>
                        
                        
                    </table>
                    
                    <div id="coment<?php echo $obra->id;?>" style="display:none;" class="comentario">
                        <?php foreach($comment as $comentario){
                            if($comentario->obra==$obra->id){
                                echo "<div class='thecomentario'><p class='username'>$comentario->user</p>";
                                echo "<p class='txtcomentario'>$comentario->texto </p>";
                                echo "<p class='timecomentario'>$comentario->horario</p></div>";
                            }
                        }
                        
                        if (talogado()){ ?>
                            <form action="livros.php" method="post" >
                                <ul class="form-style-1">
                                    <li>
                                        <textarea name="texto" cols="45" id="campo<?php echo $obra->id;?>" rows="5" onkeyup="contarCaracteres(this.value,140,'sprestante<?php echo $obra->id;?>','campo<?php echo $obra->id;?>')"></textarea>
                                    </li>
                                    <li><span id="sprestante<?php echo $obra->id;?>" style="font-family:Georgia;"></span></li>
                                    <input type="hidden" name="idobra" value="<?php echo $obra->id; ?>" />
                                    <input type="hidden" name="iduser" value="<?php echo $_SESSION['user']; ?>" />
                                    <li>
                                        <input type="submit" value="comentar" name="enviacomentario">
                                    </li>
                                </ul>
                            </form>
                        <?php }else{
                            echo "<div class='thecomentario'><p class='txtcomentario'>
                            você precisa estar logado para comentar
                            <a href='login.php'>Login</a>
                            <a href='cadastro.php'>Cadastrar</a></p></div>";
                        }?>
                    </div>
                </article>    
            <?php }?>
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
