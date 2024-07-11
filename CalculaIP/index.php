<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora IP</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
    <form action="res/resposta.php" method="post">
        <div class="form">
            <p>Insira o endereço de IPv4 e a máscara de rede</p><br>
            <br>
            <div class="lin"></div>
            <br>
            <p>IPv4:</p>
            <input required type="number" name="p1" min="0" max="255" placeholder="0">&ensp;.&ensp;
            <input required type="number" name="p2" min="0" max="255" placeholder="0">&ensp;.&ensp;
            <input required type="number" name="p3" min="0" max="255" placeholder="0">&ensp;.&ensp;
            <input required type="number" name="p4" min="0" max="255" placeholder="0">
            <br>
            <br>
            <p>Máscara de rede:</p>
            <select required name="mascara">
                <?php
                    $a = 0;
                    while ($a < 32) {
                        $a++;
                        echo "<option value='$a'>$a</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <br>
            <div class="lin"></div>
            <br>
            <br>
            <div class="ani">
                <button class="cal" type="submit">Calcular</button>
            </div>
        </div>
        </center>
    </form>
</body>
</html>