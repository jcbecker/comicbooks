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
            if (adminlogado()){
                echo "
                <nav>
                <ul>
                    <li><a href='usermanager.php'>Gerenciar Leitores</a></li>
                    <li><a href='postobra.php'>Postar Obra</a></li>
                    <li><a href='user.php'>Postar Noticia</a></li>
                </ul>
                </nav>";//falta fazer para postar obra e noticia
            }
            
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
                <tr>
                    <td><form action="user.php" method="POST">
                        <input value="Excluir Conta" name="deleteuser" type="submit">
                    </form></td>
                </tr>
                
                
                
                
            </table>
            <?php
            if ((isset($_POST['editaruser']))||$_GET['p']=='editaruser'){
                if ((isset($_POST['editaruser']))){
                    $_SESSION['nome']=$con['nome'];
                    $_SESSION['email']=$con['email'];
                }
                
                include "conteudo/editaruser.php";
            }
            
            if ((isset($_POST['deleteuser']))){
                echo "
                <script>
                if(confirm('Deseja realmente fazer isso?')) {
                    location.href='conteudo/deleteuser.php';
                } 
                </script>
                ";
            }
            
            
            ?>
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
