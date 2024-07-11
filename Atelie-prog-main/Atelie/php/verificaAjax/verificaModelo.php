<?php
    $campo = $_GET['campo'];
    $valor = $_GET['valor'];

    if ($campo == "tecidos") {
        if ($valor == "") {
            echo "Preencha o campo com o(s) tipo(s) de Tecido(s)";
        }
    } else if ($campo == "cores") {
        if ($valor == "") {
            echo "Preencha o campo com a(s) Cor(es)";
        } 
    } else if ($campo == "decoracao") {
        if ($valor == "") {
            echo "Preencha o campo com a(s) Decoracao(oes)";
        } 
    } else if ($campo == "met_tec") {
        if ($valor == "") {
            echo "Preencha o campo com a Metragem do tecido";
        } 
    } else if ($campo == "valortecido") {
        if ($valor == "") {
            echo "Preencha o campo com o Valor do Tecido";
        } 
    } else if ($campo == "valortrab") {
        if ($valor == "") {
            echo "Preencha o campo com o Valor do Trabalho";
        } 
    } else if ($campo == "valordec") {
        if ($valor == "") {
            echo "Preencha o campo com o Valor da Decoracao";
        } 
    } 

    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>