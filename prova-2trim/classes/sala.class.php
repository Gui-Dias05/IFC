<?php
    include_once '../conf/default.inc.php';
    require_once '../conf/Conexao.php';
    require_once "../classes/database.class.php";
    abstract class Sala extends Database{
        private $id;

        public function __construct($id) {
            $this->setid($id);
        }

        public function getid(){ 
            return $this->id; 
        }

        public function setid($id){ 
            $this->id = $id;
        }

        public abstract function inserir();
        public abstract function excluir();
        public abstract function editar();
        public abstract static function listar($buscar = 0, $procurar = "");
    }
?>