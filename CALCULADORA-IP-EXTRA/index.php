<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora IP</title>
    <link rel="stylesheet" href="css/trabalho.css">
</head>
<body>
    <form class="trab" action="visual/resposta.php" method="post">
        <div class="">
            <div class="">
                <h1 class="">Informe abaixo o endereço de IPv4 e a máscara de rede</h1>
                <div class="padding">
                    <input required class="campo" type="number" name="parte1" min="0" max="255" placeholder="0" class="">&ensp;.&ensp;
                    <input required class="campo" type="number" name="parte2" min="0" max="255" placeholder="0" class="">&ensp;.&ensp;
                    <input required class="campo" type="number" name="parte3" min="0" max="255" placeholder="0" class="">&ensp;.&ensp;
                    <input required class="campo" type="number" name="parte4" min="0" max="255" placeholder="0" class="">
                
                
                <select class="campo" required name="mascara" class="">
                    <?php
                        for($i = 1; $i <= 32; $i++){
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
                <br><br>
                    </div>
                <button class="btn fade_8S" type="submit" class="">Calcular</button>
            </div>
        </div>
    </form>
</body>
</html>