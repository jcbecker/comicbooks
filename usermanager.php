<?php 
include "protect.php";
adminprotect();
include ("config/conexao.php");
$sql_code = "SELECT id, nome, email, nivel FROM user";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
if ($sql_query){
    $ola="consulta feita com sucesso";
    
}else{
    $ola="ERRO na consulta";
}
$linha=$sql_query->fetch_assoc();
?>
<!doctype html>

<html>
<head>
    <title>comicbooks | UserManager</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id="main">
        <?php include_once "conteudo/header.php"; ?>
        <div id="content">
            <!--aqui vai todo conteudo do planeta-->
            <?php 
            if (isset($_POST)){
                foreach ($_POST as $user=>$action){
                //    echo "$user = $action </br>";
                    
                }
                if ($action=='invit'||$action=='delete'){
                    if ($action=='invit'){
                        $sql_code = "UPDATE user SET
                        nivel=2
                        WHERE id = '$user'";
                    }elseif($action=='delete'){
                        $sql_code = "DELETE FROM user WHERE id = '$user'";
                    }
                    $sql_query2 = $mysqli->query($sql_code) or die($mysqli->error);
                    if ($sql_query2){
                    //    echo "consulta feita com sucesso";
                        header("Location:user.php");
                    }else{
                        echo "ERRO na consulta";
                    }
                }
                
            }
            
            
            ?>
            
            <table>
                <tr>
                    <td>ID/Login</td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Nivel</td>
                    <td>InviteAdmin</td>
                    <td>Excluir</td>    
                </tr>
                <?php 
                do{
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td>".$linha['email']."</td>";
                    if ($linha['nivel']==2) echo "<td>Admin</td>";
                    else echo "<td>Leitor</td>";
                    echo "
                    <td><form method='post' action='usermanager.php'><input type='submit' name='$linha[id]' value='invit' /></form></td>
                    ";
                    echo "
                    <td><form method='post' action='usermanager.php'><input type='submit' name='$linha[id]' value='delete' /></form></td>
                    ";
                    echo "</tr>";
                    
                }while($linha=$sql_query->fetch_assoc());
                ?>
                
            </table>
            
            
            
            
            
            
        </div>
        
        
        <?php include_once "conteudo/footer.php"; ?>
    </div>
</body>
</html>
