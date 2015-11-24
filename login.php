<!doctype html>
<?php
    
    include ("config/conexao.php");
 
    $login = $_POST['login'];
    $senha = md5(md5($_POST['senha']));
    $consulta = "SELECT * FROM user where id = '$login' AND senha = '$senha'";
    $con = $mysqli->query($consulta) or die($mysqli->error);
    $con = $con->fetch_array();
    if (isset($_POST['entrar'])){
        if($con['id']==$login){
            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION['nivel']=$con['nivel'];//ainda não foi testado
            $_SESSION['user']=$login;
            $vflag=true;
        }else{
            echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.php';</script>";
            $vflag=false;
        }
        unset ($_POST['senha'],$_POST['login'],$consulta,$con,$senha,$login);//mata tudo
        if($vflag){
            header("Location:index.php");
        }
    }
    
    
    
    
//    if (isset($entrar)) {
//        $verifica = mysql_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
//        if (mysql_num_rows($verifica)<=0){
//            echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
//            die();
//        }else{
//            setcookie("login",$login);
//            header("Location:index.php");
//        }
//    }
?>
<html>
<head>
    <title>comicbooks | Login</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</script>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php";?>
        <div id="content">
            <!--aqui vai todo conteudo do planeta-->
            <form method="POST" action="login.php">
                <label>Login:</label><input type="text" name="login" id="login"><br>
                <label>Senha:</label><input type="password" name="senha" id="senha"><br>
                <input type="submit" value="entrar" id="entrar" name="entrar"><br>
                <a href="cadastro.php">Cadastre-se</a>
            </form>
            
        </div>
        <?php include_once "conteudo/footer.php";?>
    </div>
</body>
</html>
