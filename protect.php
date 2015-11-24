<?php 
if (!function_exists("protect")){
    function protect(){//tenq incluir protect.php e chamar a função protect
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['user']) || strlen($_SESSION['user'])<6 || strlen($_SESSION['user'])>30){
            header("Location:index.php");
            
        }
    }
}
if (!function_exists("adminprotect")){
    function adminprotect(){//
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['user']) || strlen($_SESSION['user'])<6 || strlen($_SESSION['user'])>30 || $_SESSION['nivel']!=2){//nivel 2 vai ser o nivel de um adm, pq sim
            header("Location:index.php");
            
        }
    }
}

if (!function_exists("talogado")){
    function talogado(){//tenq incluir protect.php e chamar a função protect
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['user']) || strlen($_SESSION['user'])<6 || strlen($_SESSION['user'])>30){
            return false;
        }
        else{
            return true;
        }
    }
}

if (!function_exists("adminlogado")){
    function adminlogado(){//tenq incluir protect.php e chamar a função protect
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['user']) || strlen($_SESSION['user'])<6 || strlen($_SESSION['user'])>30 || $_SESSION['nivel']!=2){
            return false;
        }
        else{
            return true;
        }
    }
}

?>
