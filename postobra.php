<?php 
include "protect.php";
adminprotect();
include ("config/conexao.php");



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
            <form action="postobra.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Titulo:*</label>
                <input name="titulo" required type="text">
                
                <label for="autor">Autor(a):</label>
                <input name="autor"  type="text">
                
                <label for="editora">Editora:</label>
                <input name="editora"  type="text">
                
                <label for="tipo">Tipo:*</label>
                <p><input name="tipo" required type="text">(hq,livro,manga)</p>
                
                <label for="datal">Data de lançamento:</label>
                <input name="datal" type="text">
                
                
                <label for="capa">Capa:</label>
                <input type="file"  name="capa">
                
                
                <label for="pdf">Pdf:*</label>
                <input type="file" required name="pdf">
                
                </br>
                <input type="submit" value="salvarobra" name="salvarobra">
            </form>
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
