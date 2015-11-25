<?php 
include "protect.php";
adminprotect();
include ("config/conexao.php");
if (isset($_POST['salvarobra'])){
    $extensaopdf = strtolower(substr($_FILES['pdf']['name'],-4));
    if ($extensaopdf != ".pdf"){
        $erro[]="ERRO: Arquivo que deveria ser .pdf, não é pdf";
    }
    $extensaocapa = strtolower(substr($_FILES['capa']['name'],-4));
    if ($extensaocapa != ".jpg" && $extensaocapa != ".png"){
        $erro[]="ERRO: Arquivo que deveria ser .jpg ou .png, mas não é";
    }
    if (count($erro)==0){
        $nome_pdf=md5(time()).$extensaopdf;
        $nome_capa=md5(time()).$extensaocapa;
        
        if(!move_uploaded_file($_FILES['pdf']['tmp_name'],'./upload/obra/pdf/'.$nome_pdf)){
            $erro[]="ERRO: não foi possivel upar o pdf";
        }
        if(!move_uploaded_file($_FILES['capa']['tmp_name'],'./upload/obra/capa/'.$nome_capa)){
            $erro[]="ERRO: não foi possivel upar a capa";
        }
        
        $sql_code = "INSERT INTO obra (id, titulo, autor, editora, datal, datap, tipo, pdf, capa)
        VALUES (null,'$_POST[titulo]','$_POST[autor]','$_POST[editora]',
            '$_POST[datal]',NOW(),'$_POST[tipo]','$nome_pdf','$nome_capa')";
        if ($mysqli->query($sql_code)){
        //    $erro[]="sucesso";
        }else{
            $erro[]="ERRO: não foi possovel inserir ao banco de dados";
        }
        
        
        
        
    }
    
}
else{
//    echo "não entrei";
}

?>
<!doctype html>

<html>
<head>
    <title>comicbooks | Postagem de Obra</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <p class="erro">
            <?php 
            if (count($erro)>0){
                foreach ($erro as $valor) 
                    echo "$valor <br>";
                
                echo "Name: " . $_FILES["pdf"]["name"] . "<br />";
                echo "Type: " . $_FILES["pdf"]["type"] . "<br />";
                echo "Size: " . ($_FILES["pdf"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["pdf"]["tmp_name"] . "<br />";
                
                
                echo "Name: " . $_FILES["capa"]["name"] . "<br />";
                echo "Type: " . $_FILES["capa"]["type"] . "<br />";
                echo "Size: " . ($_FILES["capa"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["capa"]["tmp_name"] . "<br />";
            }
            ?>
            </p>
            <!--aqui vai todo conteudo do planeta-->
            <form action="postobra.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Titulo:</label>
                <input name="titulo" required type="text">
                
                <label for="autor">Autor(a):</label>
                <input name="autor" required type="text">
                
                <label for="editora">Editora:</label>
                <input name="editora" required type="text">
                
                <label for="tipo">Tipo(hq,livro,manga):</label>
                <input name="tipo" required type="text">
                
                <label for="datal">Data de lançamento:</label>
                <input name="datal" required type="text">
                
                
                <label for="capa">Capa:</label>
                <input type="file" required name="capa">
                
                
                <label for="pdf">Pdf:</label>
                <input type="file" required name="pdf">
                
                </br>
                <input type="submit" value="salvarobra" name="salvarobra">
            </form>
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
