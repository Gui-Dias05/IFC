<?php
        include_once "../../php/utils/autoload.php";
        class Modelo extends Pai{
        private $tecidos;
        private $cores;
        private $decoracao;
        private $met_tec;
        private $valortecido;
        private $valortrab;
        private $valordec;
        private $medidas_id;
        private $tipo;
        private $prazo;

        public function __construct($id, $tecidos, $cores, $decoracao, $met_tec, $valortecido, $valortrab, $valordec, $medidas_id, $tipo, $prazo) {
            parent::__construct($id);
            $this->setTecidos($tecidos);
            $this->setCores($cores);
            $this->setDecoracao($decoracao);
            $this->setMettec($met_tec);
            $this->setValortecido($valortecido);
            $this->setValortrab($valortrab);
            $this->setValordec($valordec);
            $this->setMedidasid($medidas_id);
            $this->setTipo($tipo);
            $this->setPrazo($prazo);
        }   

        public function getTecidos() {
            return $this->tecidos;
        }

        public function setTecidos($tecidos) {
            $this->tecidos = $tecidos;
        }
        
        public function getCores() {
            return $this->cores;
        }

        public function setCores($cores) {
            $this->cores = $cores;
        }

        public function getDecoracao() {
            return $this->decoracao;
        }

        public function setDecoracao($decoracao) {
            $this->decoracao = $decoracao;
        }

        public function getMettec() {
            return $this->met_tec;
        }

        public function setMettec($met_tec) {
            $this->met_tec = $met_tec;
        }

        public function getValortecido() {
            return $this->valortecido;
        }

        public function setValortecido($valortecido) {
            $this->valortecido = $valortecido;
        }

        public function getValortrab() {
            return $this->valortrab;
        }

        public function setValortrab($valortrab) {
            $this->valortrab = $valortrab;
        }

        public function getValordec() {
            return $this->valordec;
        }

        public function setValordec($valordec) {
            $this->valordec = $valordec;
        }

        public function getMedidasid() {
            return $this->medidas_id;
        }

        public function setMedidasid($medidas_id) {
            $this->medidas_id = $medidas_id;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getPrazo() {
            return $this->prazo;
        }

        public function setPrazo($prazo) {
            $this->prazo = $prazo;
        }

        public function inserir(){
            $sql = 'INSERT INTO modelo (tecidos, cores, decoracao, met_tec, valortecido, valortrab, valordec, medidas_id, tipo, prazo) 
            VALUES (:tecidos, :cores, :decoracao, :met_tec, :valortecido, :valortrab, :valordec, :medidas_id, :tipo, :prazo)';
            $parametros = array(":tecidos"=>$this->gettecidos(),
                                ":cores"=>$this->getcores(),
                                ":decoracao"=>$this->getdecoracao(),
                                ":met_tec"=>$this->getMettec(),
                                ":valortecido"=>$this->getValortecido(),
                                ":valortrab"=>$this->getValortrab(),
                                ":valordec"=>$this->getValordec(),
                                ":medidas_id"=>$this->getMedidasid(),
                                ":tipo"=>$this->getTipo(),
                                ":prazo"=>$this->getPrazo());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM modelo WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE modelo 
            SET tecidos = :tecidos, cores = :cores, decoracao = :decoracao, met_tec = :met_tec, valortecido = :valortecido, valortrab = :valortrab, valordec = :valordec, medidas_id = :medidas_id, tipo = :tipo, prazo = :prazo
            WHERE id = :id';
            $parametros = array(":tecidos"=>$this->gettecidos(),
                                ":cores"=>$this->getcores(),
                                ":decoracao"=>$this->getdecoracao(),
                                ":met_tec"=>$this->getmettec(),
                                ":valortecido"=>$this->getvalortecido(),
                                ":valortrab"=>$this->getvalortrab(),
                                ":valordec"=>$this->getvalordec(),
                                ":medidas_id"=>$this->getMedidasid(),
                                ":tipo"=>$this->getTipo(),
                                ":prazo"=>$this->getPrazo(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM modelo";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE tecidos like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE cores like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE decoracao like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE met_tec like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE valortecido like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(7): $sql .= " WHERE valortrab like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(8): $sql .= " WHERE valordec like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(9): $sql .= " WHERE medidas_id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(10): $sql .= " WHERE tipo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(11): $sql .= " WHERE prazo like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM modelo";
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
            $sql = "SELECT * FROM modelo WHERE id = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>