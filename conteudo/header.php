

<header>
    <h1>COMICBOOKS</h1>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
    var topo = $('#menutop').offset().top;
    $(window).on('scroll', function() {
        if($(this).scrollTop() >= topo) {
            $('#menutop:not(.fixed)').addClass('fixed');
        } else {
            $('#menutop.fixed').removeClass('fixed');
        }
    });
});
</script>
<nav id="menutop">
    <ul>
        <a href="index.php"><li>Home</li></a>
        <a href="hqs.php"><li>HQs</li></a>
        <a href="livros.php"><li>Livros</li></a>
        <a href="index.php"><li>Notícias</li></a>
        <?php
        include_once "protect.php";
        if (!isset($_SESSION)){
            session_start();
        }
        if(talogado()){
            $nick=$_SESSION['user'];
            echo "<a href='logout.php'><li>Sair</li></a>";
            echo "<a href='user.php'><li>$nick</li></a>";
        }
        else{
        echo "<a href='cadastro.php'><li>Cadastro</li></a>
        <a href='login.php'><li>Login</li></a>";    
        }
        
        ?>
        
        
    </ul>
    
</nav>
