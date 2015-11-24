<?php 
include_once "protect.php";
protect();
if(adminlogado()){
    $conta="Admin";
}else{
    $conta="Leitor";
}
$login=$_SESSION['user'];
include ("config/conexao.php");
$consulta = "SELECT * FROM user where id = '$login'";
$con = $mysqli->query($consulta) or die($mysqli->error);
$con = $con->fetch_array();

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
            <h1>Minhas Informações</h1>
            <table>
            <caption>titulo tabela</caption>
            <tr><td><?php echo $conta ?></td></tr>
            <tr><td>Login</td><td><?php echo $con['id'] ?></td></tr>
            <tr><td>Nome</td><td><?php echo $con['nome'] ?></td></tr>
            <tr><td>Email</td><td><?php echo $con['email'] ?></td></tr>
            
            </table>
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
