<?php
    require_once "../classes/sala.class.php";
    class Reserva extends Sala{
        private $data;
        private $idprof;
        private $idlab;

        public function __construct($id, $data, $idprof, $idlab) {
            parent::__construct($id);
            $this->setdata($data);
            $this->setprof($idprof);
            $this->setlab($idlab);
        }

        public function getdata() {
            return $this->data;
        }

        public function setdata($data) {
            if ($data >  0)
                $this->data = $data;
        }

        public function getprof() {
            return $this->idprof;
        }

        public function setprof($idprof) {
            if ($idprof >  0)
                $this->idprof = $idprof;
        }

        public function getlab() {
            return $this->idlab;
        }

        public function setlab($idlab) {
            if ($idlab >  0)
                $this->idlab = $idlab;
        }

        public function __toString() {
            return  "[Reserva]<br>Id do Reserva: ".$this->getid()."<br>".
                    "data: ".$this->getdata()."<br>".
                    "Id do Professor: ".$this->getprof()."<br>".
                    "Id do Laboratorio: ".$this->getlab()."<br>";
        }

        public function inserir(){
            $sql = 'INSERT INTO prova.reserva (data, idprof, idlab) 
            VALUES(:data, :idprof, :idlab)';
            $parametros = array(":data"=>$this->getdata(), 
                                ":idprof"=>$this->getprof(),
                                ":idlab"=>$this->getlab());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM prova.reserva WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE prova.reserva 
            SET data = :data, idprof = :idprof, idlab = :idlab
            WHERE id = :id';
            $parametros = array(":data"=>$this->getdata(),
                                ":idprof"=>$this->getprof(),
                                ":idlab"=>$this->getlab(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM professores, laboratorios, reserva 
            WHERE professores.idprof = reserva.idprof AND laboratorios.id = reserva.idlab";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " && id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " && data like :procurar"; $procurar .="%"; break;
                    case(3): $sql .= " && idprof like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " && idlab like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Conexao::getInstance();
            $sql= "SELECT $rows FROM reserva";
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

        public function verificar(){
            $pdo = Database::iniciaConexao();
            $sql = "SELECT data FROM reserva;";
            $verificacao = $pdo->query($sql)->fetchAll();
            if($verificacao != ""){
                $_SESSION['data'] = $verificacao[0]['data'];
                return true;
            } else {
                $_SESSION['data'] = null;
                return false;
            }
        }
    }
?>