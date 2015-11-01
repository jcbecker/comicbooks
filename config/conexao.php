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

//mysql_connect($host, $usuario, $senha) or die (mysql_error ());
//mysql_select_db($db) or die(mysql_error());
?>
