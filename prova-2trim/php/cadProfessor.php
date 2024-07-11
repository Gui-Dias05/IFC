<!DOCTYPE html>
<?php
    include_once "../classes/autoload.php";
    $idprof = null;
    if(isset($_GET['idprof'])) {
        $idprof = $_GET['idprof'];
        $prof = new Professor('','');
        $lista = $prof->select('*', "idprof = $idprof");
    }

    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "professor";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {

            $prof = new Professor("", $nome);
            $prof->inserir();
            header("location:cadProfessor.php");
    } else if($acao == "editar") {
        try{
            $prof = new Professor($idprof, $nome);
            $prof->editar();
            header("location:cadProfessor.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $prof = new Professor($idprof, "");
            $prof->excluir();
            header("location:cadProfessor.php");
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
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Professor</title>
</head>
<body>
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <content>
    <form action="<?php if(isset($_GET['idprof'])) { echo "cadProfessor.php?idprof=$idprof&acao=editar";} else {echo "cadProfessor.php?acao=insert";}?>" method="post" id="form" style="padding-left: 0.7px;">
        <h1>Cadastrar um Professor</h1><br>
        <input readonly type="hidden" name="idprof" id="idprof" value="<?php if (isset($idprof)) echo $lista[0]['idprof'];?>">
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Nome:</div>
                <input required type="text" name="nome" id="nome" value="<?php if (isset($idprof)) echo $lista[0]['nome'];?>" class="form-control-sm border border-dark rounded-end" aria-describedby="emailHelp">
            </div>
        </div><br>
        <button name="" value="true" id="" type="submit" class="btn btn-dark">Salvar</button>
    </form><br>
    <div class="card text-bg-dark mb-3"></div>
    <form method="post" style="padding-left: 0.7px;">
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Nome</label><br>
        </div>
        <div class="col-auto";>
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
                        <th scope="col">Nome</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Professor::listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['idprof'];?></th>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><a href="cadProfessor.php?idprof=<?php echo $linha['idprof'];?>"><img src="../img/edit.svg" alt=""></a></td>
                        <td><a onclick="return confirm('Deseja mesmo excluir?')" href="cadProfessor.php?idprof=<?php echo $linha['idprof'];?>&acao=excluir"><img src="../img/trash-2.svg" alt=""></a></td>
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