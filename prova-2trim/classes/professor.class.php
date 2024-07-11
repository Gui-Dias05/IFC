<?php
    include_once '../conf/default.inc.php';
    require_once '../conf/Conexao.php';
    require_once '../classes/database.class.php';
    class Professor extends Database{
        private $idprof;
        private $nome;

        public function __construct($idprof, $nome) {
            $this->setprof($idprof);
            $this->setnome($nome);
        }

        public function getprof() {
            return $this->idprof;
        }

        public function setprof($idprof) {
            if ($idprof >  0)
                $this->idprof = $idprof;
        }     
        
        public function getnome() {
            return $this->nome;
        }

        public function setnome($nome) {
            if ($nome >  0)
                $this->nome = $nome;
        }

        public function inserir(){
            $sql = 'INSERT INTO prova.professores (nome) 
            VALUES(:nome)';
            $parametros = array(":nome"=>$this->getnome());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM prova.professores WHERE idprof = :idprof';
            $parametros = array(":idprof"=>$this->getprof());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE prova.professores 
            SET nome = :nome
            WHERE idprof = :idprof';
            $parametros = array(":nome"=>$this->getnome(),
                                ":idprof"=>$this->getprof());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM professores";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idprof like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM professores";
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
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>