<?php
    require '../classes/Calcular.class.php';
    $ip = $_POST['p1']. '.' . $_POST['p2']. '.' . $_POST['p3']. '.' . $_POST['p4'];
    $mascara = $_POST['mascara'];
    $resultado = new Calcular("$ip", "$mascara");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IP</title>
    <style>
        body{
            font-family: Helvetica;
            background: linear-gradient(270deg, #b9e7db, #7eb6a7, #2f7e69);
            background-size: 600% 600%;

             -webkit-animation: fundo 20s ease infinite;
             -moz-animation: fundo 20s ease infinite;
            animation: fundo 20s ease infinite;
        }

        @-webkit-keyframes fundo {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
        }
        
        @-moz-keyframes fundo {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
        }

        @keyframes fundo {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
        }

        input{
            border: none;
            border-radius: 12px;
            background-color: #7eb6a7;
        }

        .form{
            background-color: #b9e7db;
            width: 400px;
            padding: 2%;
            margin-top: 3%;
            border-radius: 12px;
            text-align: left;
        }

        .lin{
            background-color: #7eb6a7;
            height: 3px;
            }

        .ani{
	        height: 20%;
	        display: flex;
	        align-items: center;
            justify-content: center;
        }

        .cal{
            background: none;
            border: none;
	        font-family: Helvetica;
	        letter-spacing: 0.4em;
	        font-weight: 16;
	        font-size: 12px;
	        text-align: center;
	        color: #202125;
            cursor: pointer;
            max-width: 300px; 
            width: 100%; 
            outline: 3px solid;
            outline-color: #7eb6a7;
            outline-offset: 10px;
            transition: all 600ms cubic-bezier(0.2, 0, 0, 0.8);
            }

        .cal:hover{
	        color: #7eb6a7;
            outline-color: #477ee800;
            outline-offset: 300px;
        }
    </style>
</head>
<body>
    <center>
    <div class="form">
            <p class="">Endereço IPv4: <?php echo $ip; ?></p>
            <p>Máscara de rede: <?php echo $resultado->MRdecimal(); ?></p>
            <br>
            <div class="lin"></div>
            <br>
            <p class=""><?php echo $resultado; ?></p>
            <br>
            <div class="lin"></div>
            <br><br>

            <div class="ani">
                <a href="../index.php"><button class="cal">Voltar</button></a>
            </div>
    </div>
    </center>
</body>
</html>