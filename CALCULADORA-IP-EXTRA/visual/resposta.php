<?php
    require '../classes/Calculadora.class.php';
    $ip = $_POST['parte1']. '.' . $_POST['parte2']. '.' . $_POST['parte3']. '.' . $_POST['parte4'];
    $mascara = $_POST['mascara'];
    $calculadora = new Calculadora("$ip", "$mascara");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IP</title>
    <link rel="stylesheet" href="../css/resposta.css">

</head>
<body>
    <a href="../index.php"><button type="button">Voltar</button></a>
        <div class="padding">
            <br><br>
            <div class="">
                <p class="">O endereço IPv4 informado foi <?php echo $ip;?> e a máscara de rede foi <?php echo $calculadora->mascaraDeRedeDecimal(); ?></p>
            </div>

            <!-- ou também -->
            <p class=""><?php echo $calculadora; ?></p>
        </div>
</body>
</html>