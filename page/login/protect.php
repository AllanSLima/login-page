<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    die("Você não pode acessar está página. Logue primeiro.<p><a href=\"index.php\">Logar</a></p>");

}

?>