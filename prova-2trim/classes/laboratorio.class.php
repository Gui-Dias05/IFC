<?php
    require_once '../classes/sala.class.php';
    class Laboratorio extends Sala{
        private $num;

        public function __construct($id, $num) {
            parent::__construct($id);
            $this->setnum($num);
        }

        public function getnum() {
            return $this->num;
        }

        public function setnum($num) {
            if ($num >  0)
                $this->num = $num;
        }

        public function __toString() {
            return  "[Laboratorio]<br>Id do Laboratorio: ".$this->getid()."<br>".
                    "num: ".$this->getnum()."<br>";
        }

        public function inserir(){
            $sql = 'INSERT INTO prova.laboratorios (num) 
            VALUES(:num)';
            $parametros = array(":num"=>$this->getnum());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM prova.laboratorios WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE prova.laboratorios
            SET num = :num
            WHERE id = :id';
            $parametros = array(":num"=>$this->getnum(), 
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM laboratorios";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE num like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $sql= "SELECT $rows FROM laboratorios";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            $pdo = Conexao::getInstance();
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>