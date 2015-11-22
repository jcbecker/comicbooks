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
/*
$(function () {
    var navigations = $('#menutop'),
        pos = navigations.offset();
    $(window).scroll(function () {
        if ($(this).scrollTop() > pos.top + navigations.height() && navigations.hasClass('normal')) {
            navigations.fadeOut('fast', function () {
                $(this).removeClass('normal').addClass('estavel').fadeIn('fast')
            })
        } else if ($(this).scrollTop() <= pos.top && navigations.hasClass('estavel')) {
            navigations.fadeOut('fast', function () {
                $(this).removeClass('estavel').addClass('normal').fadeIn('fast')
            })
        }
    })
});*/
</script>
<nav id="menutop">
    <ul>
        <a href="index.php"><li>Home</li></a>
        <a href="index.php"><li>HQs</li></a>
        <a href="index.php"><li>Livros</li></a>
        <a href="index.php"><li>Noticias</li></a>
        <a href="index.php"><li>Cadastro</li></a>
        <a href="index.php"><li>Login</li></a>
        
    </ul>
    
</nav>
