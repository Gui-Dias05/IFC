<?php
$valor1 = isset($_POST['valor1']) ? $_POST['valor1'] : 1;
$valor2 = isset($_POST['valor2']) ? $_POST['valor2'] : 2;

if ($valor1 != 0 || $valor2 != 0){
     $soma = $valor1 + $valor2;
     $subtracao = $valor1 - $valor2;
     $mutiplicacao = $valor1 * $valor2;
     $divisao = $valor1 / $valor2;

     echo "<h1> Os resultados são: </h1><p>Adição: ".$soma.".<br> Subtração:".$subtracao.".<br> Mutiplicação:".$mutiplicacao.".<br> Divisão:".$divisao.".</p>";
 
}else { echo "<h1> Erro! </h1>";}


?>