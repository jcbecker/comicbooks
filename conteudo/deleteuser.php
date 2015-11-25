<?php 

include "../config/conexao.php";
session_start();

$sql_code = "DELETE FROM user WHERE id = '$_SESSION[user]'";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

if ($sql_query){
    unset ($_SESSION['user'],$_SESSION['nivel']);
    header("Location:../index.php");
    
}else{
    echo "
    <script>
    alert('ERRO: não foi possivel excluir a sua conta');
    </script>";
}


?>
