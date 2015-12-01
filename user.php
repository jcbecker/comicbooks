<?php 
/*faz proteção para quem não ta logado*/
include_once "protect.php";
protect();
if(adminlogado()){
    $conta="Admin";
}else{
    $conta="Leitor";
}
/*carrega informações do usuario no banco*/
$login=$_SESSION['user'];
include ("config/conexao.php");
$consulta = "SELECT * FROM user where id = '$login'";
$con = $mysqli->query($consulta) or die($mysqli->error);
$con = $con->fetch_assoc();
unset ($con['senha']);

?>
<!doctype html>

<html lnag"pt-br">
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
            /*mostra conteudo apenas se um admin for logado*/
            if (adminlogado()){
                echo "
                <nav class='outromenu'>
                <ul>
                    <li><a href='usermanager.php'>Gerenciar Leitores</a></li>
                    <li><a href='postobra.php'>Postar Obra</a></li>
                    
                </ul>
                </nav>";
            }
            
            ?>
            
            <h1>Minhas Informações</h1>
            <table id="myinfos">
                
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
                </table>
                
                <form action="user.php" method="POST">
                    <ul class="form-style-1">
                        <li>
                        <input value="Editar" name="editaruser" type="submit">
                        </li>
                        <li>
                        <input value="Excluir Conta" name="deleteuser" type="submit">
                        </li>
                    </ul>
                </form>
                
                
            
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
