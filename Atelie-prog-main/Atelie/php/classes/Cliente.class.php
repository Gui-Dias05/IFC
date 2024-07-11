<?php
        include_once "../../php/utils/autoload.php";
        class Cliente extends Pai{
        private $nome;
        private $telefone;
        private $tipo;
        private $costureira_id;

        public function __construct($id, $nome, $telefone, $tipo,Costureira $costureira_id) {
            parent::__construct($id);
            $this->setNome($nome);
            $this->setTelefone($telefone);
            $this->setTipo($tipo);
            $this->costureira_id = $costureira_id;
        }     

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getTelefone() {
            return $this->telefone;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getCostureiraid() {
            return $this->costureira_id;
        }

        public function setCostureiraid(Costureira $costureira_id) {
            $this->costureira_id = $costureira_id;
        }

        public function inserir(){
            $sql = 'INSERT INTO cliente (nome, telefone, tipo, costureira_id) 
            VALUES (:nome, :telefone, :tipo, :costureira_id)';
            $parametros = array(":nome"=>$this->getNome(),
                                ":telefone"=>$this->getTelefone(),
                                ":tipo"=>$this->getTipo(),
                                ":costureira_id"=>$this->getCostureiraid());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM cliente WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE cliente 
            SET nome = :nome, telefone = :telefone, tipo = :tipo, costureira_id = :costureira_id
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getNome(),
                                ":telefone"=>$this->getTelefone(),
                                ":tipo"=>$this->getTipo(),
                                ":costureira_id"=>$this->getCostureiraid(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM cliente";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE telefone like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE tipo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE costureira_id like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM cliente";
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

        public static function consultarData($id){
            $sql = "SELECT * FROM cliente WHERE id = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>