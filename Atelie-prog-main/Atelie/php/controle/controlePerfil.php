<?php
    include_once ("../utils/autoload.php");
    session_start();
    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }
        if($acao == "editar") {
            if(strlen($_POST['novasenha']) >= 6) {
                $usu = new Usuario($_SESSION['id'], $_POST['nome'], $_POST['email'], $_POST['novasenha'], $_SESSION['tipo'], $_POST['cpf'], $_POST['telefone'], $_POST['curriculo'], $_SESSION['status']);
                $usu->editar();
            } else {
                $usu = new Usuario($_SESSION['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_SESSION['tipo'], $_POST['cpf'], $_POST['telefone'], $_POST['curriculo'], $_SESSION['status']);
                $usu->editar();
            }
            header("Location:../../view/usuario/perfil.php?msg=Usuário alterado com sucesso!");
        } else if($acao = "excluir") {
            $usu = new Usuario($_SESSION['id'], "", "", "", "", "", "", "", "desativado");
            $usu->excluir();
            header("Location:../../view/usuario/login.php");
        }
?>