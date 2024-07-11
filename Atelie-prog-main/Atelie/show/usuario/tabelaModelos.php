<?php
    include_once "../../php/utils/autoload.php";
    include_once "../../php/utils/utilidades.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $mod = new Modelo('','','','','','','','','','','');
        $lista = $mod->listar(1, $id);
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
    $title = "Lista de detalhes";
    $table = "Modelo";

    $pdo = Database::iniciaConexao();
    $consulta = $pdo->query("SELECT cliente.nome FROM medidas, cliente WHERE cliente.id = medidas.cliente_id;");
    foreach ($consulta as $linha) {
        $nome = $linha['nome'];
    }

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
            padding: 1em;
            width: 1em;
        }

        table{
            margin-left: 10%;
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
                    <h1 class="text-center" style="font-family: lato;">Detalhes</h1>
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
                                <td scope="col">Tecidos</td>
                                <td scope="col">Cores</td>
                                <td scope="col">Decoração</td>
                                <td scope="col">Metragem(tecido)</td>
                                <td scope="col">Tecido(valor)</td>
                                <td scope="col">Trabalho(valor)</td>
                                <td scope="col">Decoração(valor)</td>
                                <td scope="col">Cliente</td>
                                <td scope="col">Tipo de peça</td>
                                <td scope="col">Total</td>
                                <td scope="col">Alterar</td>
                                <td scope="col">Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $lista = Modelo::listar($buscar, $procurar);
                            foreach ($lista as $linha) {

                            $valorfim = $linha['valortecido'] + $linha['valortrab'] + $linha['valordec'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $linha['tecidos'];?></td>
                                <td scope="row"><?php echo $linha['cores'];?></td>
                                <td scope="row"><?php echo $linha['decoracao'];?></td>
                                <td scope="row"><?php echo $linha['met_tec']."m";?></td>
                                <td scope="row"><?php echo "R$".number_format($linha['valortecido'], 2, ',', '.');?></td>
                                <td scope="row"><?php echo "R$".number_format($linha['valortrab'], 2, ',', '.');?></td>
                                <td scope="row"><?php echo "R$".number_format($linha['valordec'], 2, ',', '.');?></td>
                                <td scope="row"><?php echo cliente($linha['medidas_id']);?></td>
                                <td scope="row"><?php echo $linha['tipo'];?></td>
                                <td scope="row"><?php echo $linha['prazo'];?></td>
                                <td scope="row"><?php echo "R$".number_format($valorfim, 2, ',', '.');?></td>
                                <td scope="row"><a href="cadModelo.php?id=<?php echo $linha['id']?>"><img src="../../img/editar.svg" alt=""></a></td>
                                <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadModelo.php?id=<?php echo $linha['id']?>&acao=excluir"><img src="../../img/excluir.svg" alt=""></a></td>
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