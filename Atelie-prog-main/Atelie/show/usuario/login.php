<?php
    include_once "../../php/utils/autoload.php";
    $dados = isset($_GET['dados']) ? $_GET['dados'] : "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="../../js/ajaxLogin.js"></script>
    <link rel="stylesheet" href="../../css/cad.css">
    <title>Login</title>
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
                    <h1 class="text-center">Login</h1>
                    <br>
                    <div class="lin"></div> 
                    <br>
                    <form method="POST" action="../../php/controle/controleLogin.php">
                    <div class="form">
                        <br>
                        <label for="email">Email:</label><br>
                            <input type="email" name="email" placeholder="Insira seu email" id="email" required value="<?php if (isset($id)) echo $lista[0]['email'];?>" onblur="validarDados('email', document.getElementById('email').value);">
                            <div id="campo_email"> </div><br>
                        <label for="senha">Senha:</label><br>
                            <input type="password" name="senha" placeholder="Insira sua senha" id="senha" required minlength="4" value="<?php if (isset($id)) echo $lista[0]['senha'];?>" onblur="validarDados('senha', document.getElementById('senha').value);">
                            <div id="campo_senha"></div><br>
                        <?php
                            if($dados == "errado"){
                                echo "Dados incorretos";
                            }
                        ?>
                    </div>
                        <br>
                        <center>
                        <button type="submit" class="save">Salvar</button><br>
                        <a href="cadastrar.php">Cadastrar</a>
                        </center>
                    </form>
                </div>
            </div>
    </section>
</body>
</html>