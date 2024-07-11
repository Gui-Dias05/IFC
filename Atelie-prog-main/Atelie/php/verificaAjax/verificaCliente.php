<?php
    $campo = $_GET['campo'];
    $valor = $_GET['valor'];

    if ($campo == "nome") {
        if ($valor == "") {
            echo "Preencha o campo com seu Nome";
        }
    } else if ($campo == "telefone") {
        if ($valor == "") {
            echo "Preencha o campo com seu Telefone";
        } 
    } 

    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>