<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) { 
        $id = $_GET['id'];
        $med = new Medidas('','','','','','','','','','','','','');
        $lista = $med->select('*', "id = $id");
    }

    $title = "Cadastrar medidas";
    $altura = isset($_POST["altura"]) ? $_POST["altura"] : 0;
    $busto = isset($_POST["busto"]) ? $_POST["busto"] : 0;
    $quadril = isset($_POST["quadril"]) ? $_POST["quadril"] : 0;
    $ombro = isset($_POST["ombro"]) ? $_POST["ombro"] : 0;
    $ombro_c = isset($_POST["ombro_c"]) ? $_POST["ombro_c"] : 0;
    $larg_omb = isset($_POST["larg_omb"]) ? $_POST["larg_omb"] : 0;
    $comp_s = isset($_POST["comp_s"]) ? $_POST["comp_s"] : 0;
    $manga_comp = isset($_POST["manga_comp"]) ? $_POST["manga_comp"] : 0;
    $punho = isset($_POST["punho"]) ? $_POST["punho"] : 0;
    $cintura = isset($_POST["cintura"]) ? $_POST["cintura"] : 0;
    $cliente_id = isset($_POST["cliente_id"]) ? $_POST["cliente_id"] : 0;
    $tipo = $_GET["tipo"];

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $med = new Medidas('', $altura, $busto, $quadril, $ombro, $ombro_c, $larg_omb, $comp_s, $manga_comp, $punho, $cintura, $cliente_id, $tipo);
            $med->inserir();
            header("location:tabelaMedidas.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $med = new Medidas($id, $altura, $busto, $quadril, $ombro, $ombro_c, $larg_omb, $comp_s, $manga_comp, $punho, $cintura, $cliente_id, $tipo);
            $med->editar();
            header("location:tabelaMedidas.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $med = new Medidas($id,"","","","","","","","","","","","");
            $med->excluir();
            header("location:tabelaMedidas.php");
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
    <link rel="stylesheet" href="../../css/cad.css">
    <script type="text/javascript" src="../../js/ajaxMedidas.js"></script>
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
                    <h1 class="text-center" style="font-family: lato;">Cadastrar Medidas</h1>
                    <br>
                    <div class="lin"></div> 
                    <br>
                    <br>
                    <form action="<?php if(isset($_GET['id'])) { echo "cadMedidas.php?id=$id&acao=editar";} else {echo "cadMedidas.php?acao=insert";}?>" method="POST"  style="font-family: lato;">
                    <div class="form">
                    <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
                        <label for="al">Altura:</label><br>
                            <input type="text" name="altura" id="altura" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['altura'];?>" onblur="validarDados('altura', document.getElementById('altura').value);">
                            <div id="campo_altura"> </div><br>
                        <label for="bs">Busto:</label><br>
                            <input type="text" name="busto" id="busto" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['busto'];?>" onblur="validarDados('busto', document.getElementById('busto').value);">
                            <div id="campo_busto"> </div><br>
                        <label for="qd">Quadril:</label><br>
                            <input type="text" name="quadril" id="quadril" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['quadril'];?>" onblur="validarDados('quadril', document.getElementById('quadril').value);">
                            <div id="campo_quadril"> </div><br>
                        <label for="om">Ombro:</label><br>
                            <input type="text" name="ombro" id="ombro" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['ombro'];?>" onblur="validarDados('ombro', document.getElementById('ombro').value);">
                            <div id="campo_ombro"> </div><br>
                        <label for="omc">Ombro até cintura:</label><br>
                            <input type="text" name="ombro_c" id="ombro_c" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['ombro_c'];?>" onblur="validarDados('ombro_c', document.getElementById('ombro_c').value);">
                            <div id="campo_ombro_c"> </div><br>
                        <label for="lgo">Largura do ombro:</label><br>
                            <input type="text" name="larg_omb" id="larg_omb" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['larg_omb'];?>" onblur="validarDados('larg_omb', document.getElementById('larg_omb').value);">
                            <div id="campo_larg_omb"> </div><br>
                        <label for="cs">Comp. da saia:</label><br>
                            <input type="text" name="comp_s" id="comp_s" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['comp_s'];?>" onblur="validarDados('comp_s', document.getElementById('comp_s').value);">
                            <div id="campo_comp_s"> </div><br>
                        <label for="cm">Comp. da manga:</label><br>
                            <input type="text" name="manga_comp" id="manga_comp" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['manga_comp'];?>" onblur="validarDados('manga_comp', document.getElementById('manga_comp').value);">
                            <div id="campo_manga_comp"> </div><br>
                        <label for="pn">Punho:</label><br>
                            <input type="text" name="punho" id="punho" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['punho'];?>" onblur="validarDados('punho', document.getElementById('punho').value);">
                            <div id="campo_punho"> </div><br>
                        <label for="ci">Cintura:</label><br>
                            <input type="text" name="cintura" id="cintura" placeholder="Insira a medida em 'cm' " required value="<?php if (isset($id)) echo $lista[0]['cintura'];?>" onblur="validarDados('cintura', document.getElementById('cintura').value);">
                            <div id="campo_cintura"> </div><br>
                        <label for="cl">Cliente:</label><br>
                            <select name="cliente_id" id="cliente_id">
                                <?php
                                    $pdo = Database::iniciaConexao();
                                    $consulta = $pdo->query("SELECT * FROM cliente WHERE tipo = '$tipo'");
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