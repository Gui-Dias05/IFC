<?php
    $campo = $_GET['campo'];
    $valor = $_GET['valor'];

    if ($campo == "altura") {
        if ($valor == "") {
            echo "Preencha o campo com seu Altura";
        } 
    } else if ($campo == "busto") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da medida do Busto";
        }
     
    } else if ($campo == "quadril") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da medida do Quadril";
        }
    } else if ($campo == "ombro") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da medida do Ombro"; 
        }
    }   else if ($campo == "ombro_c") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da distancia do ombro ate a cintura"; 
        }
    }   else if ($campo == "larg_omb") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da largura do Ombro"; 
        }
    }   else if ($campo == "comp_s") {
        if ($valor == "") {
            echo "Preencha o campo com o valor do comprimento da Saia"; 
        }
    }   else if ($campo == "manga_comp") {
        if ($valor == "") {
            echo "Preencha o campo com o valor do comprimento da Manga"; 
        }
    }   else if ($campo == "punho") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da medida do Punho"; 
        }
    }   else if ($campo == "cintura") {
        if ($valor == "") {
            echo "Preencha o campo com o valor da medida da Cintura"; 
        }
    }   else if ($campo == "prazo") {
        if ($valor == "") {
            echo "Preencha o campo com o prazo desejado"; 
        }
    }    
    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>