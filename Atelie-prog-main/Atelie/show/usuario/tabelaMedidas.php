<?php
    include_once "../../php/utils/autoload.php";
    include_once "../../php/utils/utilidades.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $med = new Medidas('','','','','','','','','','','','','','','','','','','','','','','');
        $lista = $med->listar(1, $id);
    }

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $title = "Lista de medidas";
    $table = "Medidas";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/tabs.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title><?php echo $title; ?></title>
    <style>
        td{
            padding: 11px;
        }

        table{
            margin-left: 24%;
        }
    </style>
</head>
<body>
    <header>
        <p style="font-family: 'tang'; font-size: 1.3em;">Ateliê E.S</p>
    </header>
    <br>
    <section class="content-site">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="home.php" class="types"><img src="../../img/arrow.svg" alt="" style="width: 2em;"></a>
                    <h1 class="text-center" style="font-family: lato;">Medidas</h1>
                    <br>
                    <div class="lin"></div>
                    <br><br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <table border='1'>
                        <thead>
                            <tr>
                                <td scope="col">Altura</td>
                                <td scope="col">Busto</td>
                                <td scope="col">Quadril</td>
                                <td scope="col">Ombro</td>
                                <td scope="col">Ombro até Cintura</td>
                                <td scope="col">Largura do Ombro</td>
                                <td scope="col">Comprimento da Saia</td>
                                <td scope="col">Comprimento da Manga</td>
                                <td scope="col">Punho</td>
                                <td scope="col">Cintura</td>
                                <td scope="col">Prazo</td>
                                <td scope="col">Cliente</td>
                                <td scope="col">Alterar</td>
                                <td scope="col">Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $lista = Medidas::listar($buscar, $procurar);
                            foreach ($lista as $linha) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $linha['altura']."cm";?></td>
                                <td scope="row"><?php echo $linha['busto']."cm";?></td>
                                <td scope="row"><?php echo $linha['quadril']."cm";?></td>
                                <td scope="row"><?php echo $linha['ombro']."cm";?></td>
                                <td scope="row"><?php echo $linha['ombro_c']."cm";?></td>
                                <td scope="row"><?php echo $linha['larg_omb']."cm";?></td>
                                <td scope="row"><?php echo $linha['comp_s']."cm";?></td>
                                <td scope="row"><?php echo $linha['manga_comp']."cm";?></td>
                                <td scope="row"><?php echo $linha['punho']."cm";?></td>
                                <td scope="row"><?php echo $linha['cintura']."cm";?></td>
                                <td scope="row"><?php echo date("d/m/Y",strtotime($linha['prazo']));?></td>
                                <td scope="row"><?php echo cliente($linha['cliente_id']);?></td>
                                <td scope="row"><a href="cadMedidas.php?id=<?php echo $linha['id']?>"><img src="../../img/editar.svg" alt=""></a></td>
                                <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadMedidas.php?id=<?php echo $linha['id']?>&acao=excluir"><img src="../../img/excluir.svg" alt=""></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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

                                
                        