<?php
    include_once "../../php/utils/autoload.php";
    include_once "../../php/utils/utilidades.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $mod = new Modelo('','','','','','','','','','','');
        $lista = $mod->listar(1, $id);
    }

    $title = "Cadastrar detalhes";
    $tecidos = isset($_POST["tecidos"]) ? $_POST["tecidos"] : "";
    $cores = isset($_POST["cores"]) ? $_POST["cores"] : "";
    $decoracao = isset($_POST["decoracao"]) ? $_POST["decoracao"] : "";
    $met_tec = isset($_POST["met_tec"]) ? $_POST["met_tec"] : 0;
    $valortecido = isset($_POST["valortecido"]) ? $_POST["valortecido"] : 0;
    $valortrab = isset($_POST["valortrab"]) ? $_POST["valortrab"] : 0;
    $valordec = isset($_POST["valordec"]) ? $_POST["valordec"] : 0;
    $medidas_id = isset($_POST["medidas_id"]) ? $_POST["medidas_id"] : 0;
    $prazo = isset($_POST["prazo"]) ? $_POST["prazo"] : "";
    $pdo = Database::iniciaConexao();
    $consulta = $pdo->query("SELECT cliente.tipo FROM cliente, medidas WHERE medidas.cliente_id = cliente.id;");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $tipo = $linha['tipo'];
    }


    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $mod = new Modelo('', $tecidos, $cores, $decoracao, $met_tec, $valortecido, $valortrab, $valordec, $medidas_id, $tipo, $prazo);
            $mod->inserir();
            header("location:tabelaModelos.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $mod = new Modelo($id, $tecidos, $cores, $decoracao, $met_tec, $valortecido, $valortrab, $valordec, $medidas_id, $tipo, $prazo);
            $mod->editar();
            header("location:tabelaModelos.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $mod = new Modelo($id,"","","","","","","","","","");
            $mod->excluir();
            header("location:tabelaModelos.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="../../js/ajaxModelo.js"></script>
    <link rel="stylesheet" href="../../css/cad.css">
    <title><?php echo $title ?></title>
    <style>
        input{
            border-radius: 6px;
            border: none;
            background-color: #bc9371;
            color: white;
            padding-left: 5px;
            width: 15em;
        }

        select{
            border-radius: 6px;
            border: none;
            background-color: #bc9371;
            color: white;
            padding-left: 5px;
            width: 15em;
            height: 1.5em;
        }

        .save{
            background-color: white;
            border: 1px solid #bc9371;
            padding: 6px;
            color: #590202;
            border-radius: 6px;
            width: 100px;
            font-weight: bold;
        }

        .save:hover{
            background-color: #bc9371;
            transition: all .5s;
        }
    </style>
</head>
<body>
<section class="content-site">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="home.php"><img src="../../img/arrow.svg" alt="" style="width: 2em;"></a>
                    <h1 class="text-center" style="font-family: lato;">Cadastrar Detalhes</h1>
                    <br>
                    <div class="lin"></div> 
                    <br>
                    <br>
                    <form method="POST" action="<?php if(isset($_GET['id'])) { echo "cadModelo.php?id=$id&acao=editar";} else {echo "cadModelo.php?acao=insert";}?>" style="font-family: lato;">
                    <div class="form">
                        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
                        <label for="te">Tecidos:</label><br>
                            <input type="text" name="tecidos" id="tecidos" placeholder="Insira o(s) tipo(s) de tecido" required value="<?php if (isset($id)) echo $lista[0]['tecidos'];?>" onblur="validarDados('tecidos', document.getElementById('tecidos').value);">
                            <div id="campo_tecidos"> </div><br>
                        <label for="co">Cores:</label><br>
                            <input type="text" name="cores" id="cores" placeholder="Insira a(s) cor(es)" required value="<?php if (isset($id)) echo $lista[0]['cores'];?>" onblur="validarDados('cores', document.getElementById('cores').value);">
                            <div id="campo_cores"> </div><br>
                        <label for="de">Decoração:</label><br>
                            <input type="text" name="decoracao" id="decoracao" placeholder="Ex.: Strass, pérolas, etc." required value="<?php if (isset($id)) echo $lista[0]['decoracao'];?>" onblur="validarDados('decoracao', document.getElementById('decoracao').value);">
                            <div id="campo_decoracao"> </div><br>
                        <label for="me">Metragem do Tecido:</label><br>
                            <input type="text" name="met_tec" id="met_tec" placeholder="Ex.: 1.5 (em metros)" required value="<?php if (isset($id)) echo $lista[0]['met_tec'];?>" onblur="validarDados('met_tec', document.getElementById('met_tec').value);">
                            <div id="campo_met_tec"> </div><br>
                        <label for="vte">Valor do tecido:</label><br>
                            <input type="text" name="valortecido" id="valortecido" placeholder="Insira a soma do valor dos tecidos" required value="<?php if (isset($id)) echo $lista[0]['valortecido'];?>" onblur="validarDados('valortecido', document.getElementById('valortecido').value);">
                            <div id="campo_valortecido"> </div><br>
                        <label for="vtr">Valor do trabalho:</label><br>
                            <input type="text" name="valortrab" id="valortrab" placeholder="Insira o valor do trabalho" required value="<?php if (isset($id)) echo $lista[0]['valortrab'];?>" onblur="validarDados('valortrab', document.getElementById('valortrab').value);">
                            <div id="campo_valortrab"> </div><br>
                        <label for="vdec">Valor da decoração:</label><br>
                            <input type="text" name="valordec" id="valordec" placeholder="Insira a soma do valor das decorações" required value="<?php if (isset($id)) echo $lista[0]['valordec'];?>" onblur="validarDados('valordec', document.getElementById('valordec').value);">
                            <div id="campo_valordec"> </div><br>
                        <label for="pr">Prazo:</label><br>
                            <input type="date" name="prazo" id="prazo" required value="<?php if (isset($id)) echo $lista[0]['prazo'];?>" onblur="validarDados('prazo', document.getElementById('prazo').value);">
                            <div id="campo_prazo"> </div><br>
                        <label for="mid">Medidas do(a) Cliente:</label><br>
                        <select name="medidas_id" id="medidas_id">
                            <?php
                                $pdo = Database::iniciaConexao();
                                $consulta = $pdo->query("SELECT medidas.id, cliente.nome FROM cliente, medidas WHERE medidas.cliente_id = cliente.id;");
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option name="id" value="<?php echo $linha['id'];?>"><?php echo $linha['nome'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                        <br><br>
                        <center>
                            <button type="submit" class="save" >Salvar</button>
                        </center>
                    </form>
                </div>
            </div>
    </section>

</body>
</html>