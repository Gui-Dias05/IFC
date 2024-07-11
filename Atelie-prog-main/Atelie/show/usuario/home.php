<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/home.css">
    <title>Início</title>
</head>
<body>
    <?php
        require_once("menu.php");
    ?>
    <br>

    <section class="content-site">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center" style="font-family: lato;">Bem vinda!</h1>
                    <br>
                    <div class="lin"></div>
                    <br>
                    <p class="text-center">O que faremos hoje?</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="tumbnail">
                        <img src="../../img/dress.png" alt="">
                        <div class="caption text-center">
                            <a href="cadMedidas.php?tipo=vestido" class="types"><h3 style="font-family: lato;">Vestido</h3></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="tumbnail">
                        <img src="../../img/blusa.png" alt="" style="margin-left: 6%;">
                        <div class="caption text-center">
                            <a href="cadMedidas.php?tipo=blusa" class="types"><h3 style="font-family: lato;">Blusa</h3></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="tumbnail">
                        <img src="../../img/saia.png" alt="">
                        <div class="caption text-center">
                            <a href="cadMedidas.php?tipo=saia" class="types"><h3 style="font-family: lato;">Saia</h3></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer-site">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>