<?php
    $campo = $_GET['campo'];
    $valor = $_GET['valor'];

    if ($campo == "nome") {
        if ($valor == "") {
            echo "Preencha o campo com seu Nome";
        }
    } else if ($campo == "email") {
        if ($valor == "") {
            echo "Preencha o campo com seu Email";
        } 
    } else if ($campo == "senha") {
        if ($valor == "") {
            echo "Preencha o campo com seu Senha";
        } elseif (strlen($valor) < 4) {
            echo "O Senha deve ter no minimo 4 caracteres";
        }
    }

    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>