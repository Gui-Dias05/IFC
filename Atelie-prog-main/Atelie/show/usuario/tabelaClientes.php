<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $cli = new Cliente('','','','');
        $lista = $cli->listar(1, $id);
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
    $title = "Lista de clientes";
    $table = "Cliente";

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
            padding: 25px;
        }

        table{
            width: 71em;
            margin-left: 26%;
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
                    <h1 class="text-center" style="font-family: lato;">Clientes</h1>
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
                                <td scope="col">Nome</td>
                                <td scope="col">Telefone</td>
                                <td scope="col">Alterar</td>
                                <td scope="col">Excluir</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $lista = Cliente::listar($buscar, $procurar);
                            foreach ($lista as $linha) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $linha['nome'];?></td>
                                <td scope="row"><?php echo $linha['telefone'];?></td>
                                <td scope="row"><a href="cadCliente.php?id=<?php echo $linha['id']?>"><img src="../../img/editar.svg" alt=""></a></td>
                                <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadCliente.php?id=<?php echo $linha['id']?>&acao=excluir"><img src="../../img/excluir.svg" alt=""></a></td>
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