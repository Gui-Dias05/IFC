<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $cos = new Costureira('','','','');
        $lista = $cos->listar(1, $id);
    }

    $title = "Cadastrar costureira";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $cos = new Costureira('', $nome, $email, $senha);
            $cos->inserir();
            header("location:login.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../js/ajaxCadastro.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
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
            align-content: center;
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
                    <h1 class="text-center" style="font-family: lato;">Cadastre-se</h1>
                    <br>
                    <div class="lin"></div> 
                    <br>
                    <form method="POST" action="cadastrar.php?acao=insert" style="font-family: lato;">
                    <div class="form">
                        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
                        <br>
                        <label for="nome">Nome:</label><br>
                            <input type="text" name="nome" id="nome" placeholder="Insira seu nome" required value="<?php if (isset($id)) echo $lista[0]['nome'];?>" onblur="validarDados('nome', document.getElementById('nome').value);">
                            <div id="campo_nome"></div><br>
                        <label for="email">Email:</label><br>
                            <input type="email" name="email" id="email" placeholder="Insira seu email" required value="<?php if (isset($id)) echo $lista[0]['email'];?>" onblur="validarDados('email', document.getElementById('email').value);">
                            <div id="campo_email"> </div><br>
                        <label for="senha">Senha:</label><br>
                            <input type="password" name="senha" id="senha" placeholder="Insira sua senha" minlength="4" required value="<?php if (isset($id)) echo $lista[0]['senha'];?>" onblur="validarDados('senha', document.getElementById('senha').value);">
                            <div id="campo_senha"> </div>
                    </div>
                        <br><br>
                        <center>
                        <button name="acao" id="acao" type="submit" value="insert" class="save">Salvar</button><br>
                        <a href="login.php">Logar</a>
                        </center>
                    </form>
                </div>
            </div>
    </section>
</body>
</html>