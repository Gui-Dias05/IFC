<?php 
    include_once "../../php/utils/autoload.php";
    abstract class Pai extends Database{
        private $id;
        private static $contador = 0;

        public function __construct($id){
            $this->setId($id);
            self::$contador = self::$contador + 1;
        }

        public function getId(){ 
            return $this->id; 
        }

        public function setId($id){ 
            $this->id = $id;
        }

        public abstract function inserir();
        public abstract function excluir();
        public abstract function editar();
        public abstract static function listar($cnst = 0, $procurar = "");
    }
?>