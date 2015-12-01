<?php
include ("config/conexao.php");//por algum motivo tenq incluir aqui, mesmo incluindo no cadastrar.php
?>
<!doctype html>
<html lang="pt-br">
<head>
    <title>comicbooks | cadastro</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</script>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php";?>
        <div id="content">
            <!--aqui vai todo conteudo do planeta-->
            <?php include_once "conteudo/cadastrar.php"; ?>
        </div>
        <?php include_once "conteudo/footer.php";?>
    </div>
</body>
</html>
