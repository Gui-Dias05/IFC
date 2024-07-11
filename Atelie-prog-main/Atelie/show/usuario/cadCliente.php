<?php
    session_start();
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $cli = new Cliente('','','','','');
        $lista = $cli->listar(1, $id); 
    }

    $title = "Cadastrar cliente";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : 0;
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
    $costureira_id = $_SESSION['id'];


    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $cli = new Cliente('', $nome, $telefone, $tipo, $costureira_id);
            $cli->inserir();
            header("location:tabelaClientes.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $cli = new Cliente($id, $nome, $telefone, $tipo, $costureira_id);
            $cli->editar();
            header("location:tabelaClientes.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $cli = new Cliente($id, "", "", "", "");
            $cli->excluir();
            header("location:tabelaClientes.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/cad.css">
    <script type="text/javascript" src="../../js/ajaxCliente.js"></script>
    <title><?php echo $title ?></title>
    <style>
        input{
            border-radius: 6px;
            border: none;
            background-color: #bc9371;
            color: white;
            padding-left: 5px;
            width: 15em;
            align-content: center;
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
                    <h1 class="text-center" style="font-family: lato;">Cadastar Cliente</h1>
                    <br>
                    <div class="lin"></div> 
                    <br>
                    <form method="POST" action="<?php if(isset($_GET['id'])) { echo "cadCliente.php?id=$id&acao=editar";} else {echo "cadCliente.php?acao=insert";}?>" style="font-family: lato;">
                    <div class="form">
                        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
                        <label for="nome">Nome:</label><br>
                            <input type="text" name="nome" id="nome" placeholder="Insira o nome do(a) cliente" required value="<?php if (isset($id)) echo $lista[0]['nome'];?>" onblur="validarDados('nome', document.getElementById('nome').value);">
                            <div id="campo_nome"> </div><br>
                        <label for="tf">Telefone:</label><br>
                            <input type="text" name="telefone" id="telefone"  placeholder="Insira o telefone do(a) cliente" required value="<?php if (isset($id)) echo $lista[0]['telefone'];?>" onblur="validarDados('telefone', document.getElementById('telefone').value);">
                            <div id="campo_telefone"> </div><br>
                        <label for="tp">Tipo:</label><br>
                            <select class="select" name="tipo" id="tipo">
                                <option name="tipo" value="vestido">Vestido</option>
                                <option name="tipo" value="blusa">Blusa</option>
                                <option name="tipo" value="saia">Saia</option>
                            </select>
                    </div>
                        <br><br><br>
                        <center>
                        <button type="submit" class="save">Salvar</button>
                        </center>
                    </form>
                </div>
            </div>
    </section>
</body>
</html>