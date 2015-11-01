<?php  

include "senha.php";

$host = "localhost";
$usuario = "root";
$senha = $pass;
$db = "comicbooks";



$mysqli = new mysqli($host, $usuario, $senha, $db);

if ($mysqli->connect_errno){
    echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
}



//function dbclose (){
//    mysqli_close($link) or die(mysqli_error($link));
//}

//mysql_connect($host, $usuario, $senha) or die (mysql_error ());
//mysql_select_db($db) or die(mysql_error());
?>
