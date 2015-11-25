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
$con = $con->fetch_assoc();
unset ($con['senha']);

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
            <?php 
            foreach ($con as $chave=>$valor)
                echo $chave.' = '.$valor.'</br>';
            
            
            ?>
            
            <h1>Minhas Informações</h1>
            <table>
                <caption>titulo tabela</caption>
                <tr>
                    <td>Tipo de Conta</td>
                    <td><?php echo $conta ?></td>
                </tr>
                <tr>
                    <td>Login</td>
                    <td><?php echo $con['id'] ?></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><?php echo $con['nome'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $con['email'] ?></td>
                </tr>
                <tr>
                    <td><form action="user.php" method="POST">
                        <input value="Editar" name="editaruser" type="submit">
                    </form></td>
                </tr>
                
            </table>
            <?php
            if ((isset($_POST['editaruser']))||$_GET['p']=='editaruser'){
                if ((isset($_POST['editaruser']))){
                    $_SESSION['nome']=$con['nome'];
                    $_SESSION['email']=$con['email'];
                }
                
                include_once "conteudo/editaruser.php";
            }
            
            
            ?>
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
