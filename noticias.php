<?php
/*todas notícias aqui publicadas são para demonstração do layout sem intuito de serem publicadas
todos os direitos das mesmas são reservados a http://omelete.uol.com.br/*/
$var=1;

while(file_exists ('noticias/n'.$var.'.html')){
    $news[]='noticias/n'.$var.'.html';
    $var++;
}
$var--;

?>
<!doctype html>
<html  lang="pt-br">
<head>
    <title>comicbooks | Notícias</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</script>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php";?>
        <div id="content">
            <h1>Notícias</h1>
            <!--aqui vai todo conteudo do planeta-->
            <?php 
            for ($i=0;$i<$var;$i++){
                include $news[$i];
                
            }
            
            
            ?>
            
        </div>
        <?php include_once "conteudo/footer.php";?>
    </div>
</body>
</html>
