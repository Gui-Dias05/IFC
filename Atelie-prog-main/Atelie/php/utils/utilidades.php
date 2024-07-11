<?php
    function cliente($id){
        $conexão = Database::iniciaConexao();
        $vetor = $conexão->query("SELECT nome FROM cliente, medidas WHERE $id = cliente.id;");
        foreach($vetor as $lista){
            return $lista['nome'];
        }
    }
?>