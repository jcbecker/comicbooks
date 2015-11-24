<?php 
include_once "protect.php";
protect();
if(adminlogado()){
    $conta="admin";
}else{
    $conta="leitor";
}
?>
<!doctype html>

<html>
<head>
    <title>comicbooks | User</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <?php echo $conta; ?>
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
