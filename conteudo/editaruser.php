<?php
include "../config/conexao.php";

if (isset($_POST['confirmaedit'])){
    //registro dos dados
    if (!isset($_SESSION)){
        session_start();
    }
    foreach($_POST as $chave=>$valor){
        $_SESSION[$chave]=$valor;
        
    }
    //validação
    
    if (strlen($_SESSION['nome'])>70){
        $erro[] = "ERRO: Não pode ter mais de 70 carcteres no campo nome.";
    }
    if (strlen($_SESSION['senha'])<8 || strlen($_SESSION['senha'])>16){
        $erro[] = "ERRO: A senha deve ter entre 8 a 16 caracteres.";
    }
    if (strcmp($_SESSION['senha'],$_SESSION['rsenha'])!= 0){
        $erro[] = "ERRO: Senhas diferentes.";
    }
    
    
    //inserção no banco e redicionamento
    if (count($erro)==0){
        $_SESSION['senha']= md5(md5($_SESSION['senha']));
        
        $sql_code = "UPDATE user SET
        email='$_SESSION[email]',
        senha='$_SESSION[senha]',
        nome='$_SESSION[nome]'
        WHERE id = '$_SESSION[user]'";
        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        if ($confirma){//se a inserção funcionar vou excluir as variaveis
            unset ($_SESSION['email'],$_SESSION['senha'],$_SESSION['nome'],$consulta,$erro);//mata tudo mesmo
            header("Location:user.php");
        }else{
            $erro[] = "ERRO: Não foi possivel alterar os valores no banco de dados. ".$confirma;
            
        }
    }
    
}

?>

<h1>Editar Informações de Usuário</h1>
<p class="erro">
<?php 
if (count($erro)>0){
    foreach ($erro as $valor) 
        echo "$valor <br>";
}
?>
</p>
<form action="user.php?p=editaruser" method="POST">
    <ul class="form-style-1">
        
        <li>
            <label for="nome">Nome<span class="required">*</span></label>
            <input name="nome" value="<?php echo $_SESSION[nome];?>" required type="text">
        </li>
        
        <li>
            <label for="email">E-mail<span class="required">*</span></label>
            <input name="email" value="<?php echo $_SESSION[email];?>" required type="email">
        </li>
        
        <li>
            <label for="senha">Nova Senha<span class="required">*</span></label>
            <input name="senha" value="" type="password" required>8~16 caracteres
        </li>
        
        <li>
            <label for="rsenha">Repita a Senha<span class="required">*</span></label>
            <input name="rsenha" value="" type="password" required>
        </li>
        
        <li>
            <input value="Salvar" name="confirmaedit" type="submit">
        </li>
        
    </ul>
    
</form>
