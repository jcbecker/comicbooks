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
            $_SESSION['nivel']=$con['nivel'];
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
?>
<!doctype html>
<html lang="pt-br">
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
                <ul class="form-style-1">
                    <li>
                        <label>Login</label>
                        <input type="text" name="login" id="login">
                    </li>
                    
                    <li>
                        <label>Senha</label>
                        <input type="password" name="senha" id="senha">
                    </li>
                    
                    <li>
                        <input type="submit" value="entrar" id="entrar" name="entrar">
                    </li>
                    
                    <li>
                        <a href="cadastro.php">Cadastre-se</a>
                    </li>
                </ul>
            </form>
            
        </div>
        <?php include_once "conteudo/footer.php";?>
    </div>
</body>
</html>
