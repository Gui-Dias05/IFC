<?php
    include_once "../utils/autoload.php";
    //Login do usuário com sucesso, Login do usuário sem sucesso, Logout do usuário
    if(Costureira::efetuarLogin($_POST['email'], $_POST['senha'])) {
        header("Location:../../show/usuario/home.php");
    } else if(isset($_POST['email']) && isset($_POST['senha'])) {
        header("Location:../../show/usuario/login.php?dados=errado");
    } else {
        header("Location:../../show/usuario/login.php");
    }
?>