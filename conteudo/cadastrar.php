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
    $atuallogin=$_SESSION['id'];//gambiarra para corrigir aspas triplas na consulta
    $consulta = "SELECT id FROM user where id = '$atuallogin'";
    $con = $mysqli->query($consulta) or die($mysqli->error);
    $con = $con->fetch_assoc();
    
    if (strlen($_SESSION['nome'])>70){
        $erro[] = "ERRO: Não pode ter mais de 70 carcteres no campo nome.";
    }
    if (strlen($_SESSION['id'])<6 || strlen($_SESSION['id'])>30){
        $erro[] = "ERRO: Seu nome de login deve ter entre 6 a 30 caracteres.";
    }
    if($con['id']==$atuallogin){
        $erro[]="ERRO: Este login/id já existe, tente outro";
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
            unset ($_SESSION['id'],$_SESSION['email'],$_SESSION['senha'],$_SESSION['nome'],$atuallogin,$consulta,$con,$erro);//mata tudo mesmo
            
        }else{
            $erro[] = "ERRO: Não foi possivel por os valores no banco de dados. ".$confirma;
            
        }
    }
    
}

?>

<h1>Cadastrar Usuário</h1>
<p class="erro">
<?php 
if (count($erro)>0){
    foreach ($erro as $valor) 
        echo "$valor <br>";
}
?>
</p>
<form action="cadastro.php" method="POST">
    <ul class="form-style-1">
    <li>
        <label for="nome">Nome<span class="required">*</span></label>
        <input name="nome" value="<?php echo $_SESSION[nome];?>" required type="text" placeholder="Nome">
    </li>
    <li>
        <label for="id">ID, login<span class="required">*</span></label>
        <input name="id" value="<?php echo $_SESSION[id];?>" required type="text" placeholder="ID, login">6~30 caracteres
    </li>
    <li>
        <label for="email">E-mail<span class="required">*</span></label>
        <input name="email" value="<?php echo $_SESSION[email];?>" required type="email" placeholder="E-mail">
    </li>
    <li>
        <label for="senha">Senha<span class="required">*</span></label>
        <input name="senha" value="" required type="password" placeholder="Senha">8~16 caracteres
    </li>
    <li>
        <label for="rsenha">Repita a Senha<span class="required">*</span></label>
        <input name="rsenha" value="" required type="password">
    </li>
    <li>
        <input value="Salvar" name="confirmar" type="submit">
    </li>
    </ul>
    
</form>
