<?php
include "../config/conexao.php";

if (isset($_POST['confirmar'])){
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
    if (strlen($_SESSION['id'])<6 || strlen($_SESSION['id'])>30){
        $erro[] = "ERRO: Seu nome de login deve ter entre 6 a 30 caracteres.";
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
        
        $sql_code = "INSERT INTO user (id, email, senha, nome)
        VALUES(
        '$_SESSION[id]',
        '$_SESSION[email]',
        '$_SESSION[senha]',
        '$_SESSION[nome]'
        )";
        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        if ($confirma){//se a inserção funcionar vou excluir as variaveis
            unset ($_SESSION['id'],$_SESSION['email'],$_SESSION['senha'],$_SESSION['nome']);
            
        }else{
            $erro[] = "ERRO: Não foi possivel por os valores no banco de dados. ".$confirma;
            
        }
    }
    
}

?>


<h1>Cadastrar Usuário</h1>
<?php 
if (count($erro)>0){
    echo "<div class 'erro'>";
    foreach ($erro as $valor) 
        echo "$valor <br>";
    echo "</div>";
}
?>
<form action="index.php?p=cadastrar" method="POST">
    
    <label for="nome">Nome</label>
    <input name="nome" value="<?php echo $_SESSION[nome];?>" required type="text">
    
    <label for="id">ID, login</label>
    <input name="id" value="<?php echo $_SESSION[id];?>" required type="text">6~30 caracteres
    
    <label for="email">E-mail</label>
    <input name="email" value="<?php echo $_SESSION[email];?>" required type="email">
    
    <label for="senha">Senha</label>
    <input name="senha" value="" required type="password">8~16 caracteres
    
    <label for="rsenha">Repita a Senha</label>
    <input name="rsenha" value="" required type="password">
    
    <input value="Salvar" name="confirmar" type="submit">
    
</form>
