<!DOCTYPE html>
<?php
    include_once "../classes/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $lab = new Laboratorio('','');
        $lista = $lab->select('*', "id = $id");
    }

    $num = isset($_POST['num']) ? $_POST['num'] : 0;
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "laboratorios";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $lab = new Laboratorio("", $num);
            $lab->inserir();
            header("location:cadLaboratorio.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $lab = new Laboratorio($id, $num);
            $lab->editar();
            header("location:cadLaboratorio.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $lab = new Laboratorio($id, "");
            $lab->excluir();
            header("location:cadLaboratorio.php");
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
    <title>Laboratorio</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" style="padding-left: 0.7px;">
</head>
<body>
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <content>
    <form action="<?php if(isset($_GET['id'])) { echo "cadLaboratorio.php?id=$id&acao=editar";} else {echo "cadLaboratorio.php?acao=insert";}?>" method="post" id="form" style="padding-left: 0.7px;">
        <h1>Cadastrar Laboratorio</h1><br>
        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Número:</div>
                <input required type="text" name="num" id="num" value="<?php if (isset($id)) echo $lista[0]['num'];?>" class="form-control-sm border border-dark rounded-end" aria-describedby="emailHelp">
            </div>
        </div><br>
        <button name="" value="true" id="" type="submit" class="btn btn-dark">Salvar</button>
    </form><br>
    <div class="card text-bg-dark mb-3"></div>
    <form method="post" style="padding-left: 0.7px;">
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked"?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked"?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Número</label><br>
        </div>
        <div class="col-auto">        
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Procurar:</div>
                <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-md border border-dark rounded-end">
            </div><br>
        </div>
        <button name="acao" id="acao" type="submit" class="btn btn-dark">Procurar</button>
        <br><br>
    </form>
        <div>
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col" >#ID</th>
                        <th scope="col">Número</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Laboratorio::listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <th scope="row"><?php echo $linha['num'];?></th>
                        <td scope="row"><a href="cadLaboratorio.php?id=<?php echo $linha['id'];?>"><img src="../img/edit.svg" alt=""></a></td>
                        <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadLaboratorio.php?id=<?php echo $linha['id'];?>&acao=excluir"><img src="../img/trash-2.svg" alt=""></a></td>
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