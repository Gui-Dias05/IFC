<!DOCTYPE html>
<?php
    include_once "../classes/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $res = new Reserva('','','','');
        $lista = $res->select('*', "id = $id");
    }

    $data = isset($_POST['data']) ? $_POST['data'] : 0;
    $idprof = isset($_POST['idprof']) ? $_POST['idprof'] : 0;
    $idlab = isset($_POST['idlab']) ? $_POST['idlab'] : 0;
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "quadrado";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $res = new Reserva("", $data, $idprof, $idlab);
            $res->inserir();
            header("location:cadReserva.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $res = new Reserva($id, $data, $idprof, $idlab);
            $res->editar();
            header("location:cadReserva.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $res = new Reserva($id, "", "", "");
            $res->excluir();
            header("location:cadReserva.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    } 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <content>
    <form action="<?php if(isset($_GET['id'])) { echo "cadReserva.php?id=$id&acao=editar";} else {echo "cadReserva.php?acao=insert";}?>" method="post" id="form" style="padding-left: 0.7px;">
        <h1>Criar uma Reserva</h1><br>
        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Data:</div>
                <input required type="date" name="data" id="data" value="<?php if (isset($id)) echo $lista[0]['data'];?>" class="form-control-sm border border-dark rounded-end">
            </div>
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Professor:</div>
                <select name="idprof" id="idprof" value="" class="form-select-sm border border-dark rounded-end" aria-label="Floating label select example">
                <?php
                    $pdo = Database::iniciaConexao();
                    $consulta = $pdo->query("SELECT * FROM professores;");
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $linha['idprof'];?>"><?php echo $linha['nome'];?></option>
                <?php } ?>
                </select>
            </div>
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Laboratorio:</div>
                <select name="idlab" id="idlab" value="" class="form-select-sm border border-dark rounded-end" aria-label="Floating label select example">
                <?php
                    $pdo = Database::iniciaConexao();
                    $consulta = $pdo->query("SELECT * FROM laboratorios;");
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $linha['id'];?>"><?php echo $linha['num'];?></option>
                <?php } ?>
                </select>
            </div>
        </div><br>
        <button name="" value="true" id="" type="submit" class="btn btn-dark">Salvar</button>
    </form><br><br>
    <div class="card text-bg-dark mb-3"></div>
    <form method="post" style="padding-left: 0.7px;">
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Data</label><br>
            <input type="radio" name="buscar" value="3" <?php if ($buscar == "3") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Professor</label><br>
            <input type="radio" name="buscar" value="4" <?php if ($buscar == "4") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Laboratorio</label><br>
        </div>
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Procurar:</div>
                <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
            </div><br>
        </div>
        <button name="acao" id="acao" type="submit" class="btn btn-dark">Procurar</button>
        <br><br>
    </form>
        <div>
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#ID</th>
                        <th scope="col">Data</th>
                        <th scope="col">Professor</th>
                        <th scope="col">Laboratorio</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Reserva::listar($buscar, $procurar);
                    foreach ($lista as $linha) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <th scope="row"><?php $date = strtotime($linha['data']);$dia = date('d/m/Y',$date);echo $dia;?></th>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <th scope="row"><?php echo $linha['num'];?></th>
                        <td scope="row"><a href="cadReserva.php?id=<?php echo $linha['id'];?>&idprof=<?php echo $linha['idprof'];?>"><img src="../img/edit.svg" alt=""></a></td>
                        <td><a onclick="return confirm('Deseja mesmo excluir?')" href="cadReserva.php?id=<?php echo $linha['id'];?>&acao=excluir"><img src="../img/trash-2.svg" alt=""></a></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </content>
    <div class="card text-bg-dark mb-3"></div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>