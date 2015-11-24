<?php 
include_once "protect.php";
protect();
if(adminlogado()){
    $conta="admin";
}else{
    $conta="leitor";
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
            <?php echo $conta."</br></br></br>"; ?>
            <?php 
            echo "email =".$con['email'].'<br>';
            echo "nome =".$con['nome'].'<br>';
            echo "id =".$con['id'].'<br>';
            echo "nivel =".$con['nivel'].'<br>';
            
            
            ?>
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
