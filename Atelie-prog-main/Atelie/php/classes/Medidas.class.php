<?php
        include_once "../../php/utils/autoload.php";
        class Medidas extends Pai{
        private $altura;
        private $busto;
        private $quadril;
        private $ombro;
        private $ombro_c;
        private $larg_omb;
        private $comp_s;
        private $manga_comp;
        private $punho;
        private $cintura;
        private $tipo;
        private $cliente_id;

        public function __construct($id, $altura, $busto, $quadril, $ombro, $ombro_c, $larg_omb, $comp_s, $manga_comp, $punho, $cintura, $cliente_id, $tipo) {
            parent::__construct($id);
            $this->setAltura($altura);
            $this->setBusto($busto);
            $this->setQuadril($quadril);
            $this->setOmbro($ombro);
            $this->setOmbroc($ombro_c);
            $this->setLargomb($larg_omb);
            $this->setComps($comp_s);
            $this->setMangacomp($manga_comp);
            $this->setPunho($punho);
            $this->setCintura($cintura);
            $this->setClienteid($cliente_id);
            $this->setTipo($tipo);
        }

        public function getAltura() {
            return $this->altura;
        }

        public function setAltura($altura) {
            $this->altura = $altura;
        }

        public function getBusto() {
            return $this->busto;
        }

        public function setBusto($busto) {
            $this->busto = $busto;
        }

        public function getQuadril() {
            return $this->quadril;
        }

        public function setQuadril($quadril) {
            $this->quadril = $quadril;
        }

        public function getOmbro() {
            return $this->ombro;
        }

        public function setOmbro($ombro) {
            $this->ombro = $ombro;
        }
        
        public function getOmbroc() {
            return $this->ombro_c;
        }

        public function setOmbroc($ombro_c) {
            $this->ombro_c = $ombro_c;
        }

        public function getLargomb() {
            return $this->larg_omb;
        }

        public function setLargomb($larg_omb) {
            $this->larg_omb = $larg_omb;
        }

        public function getComps() {
            return $this->comp_s;
        }

        public function setComps($comp_s) {
            $this->comp_s = $comp_s;
        }

        public function getMangacomp() {
            return $this->manga_comp;
        }

        public function setMangacomp($manga_comp) {
            $this->manga_comp = $manga_comp;
        }

        public function getPunho() {
            return $this->punho;
        }

        public function setPunho($punho) {
            $this->punho = $punho;
        }

        public function getCintura() {
            return $this->cintura;
        }

        public function setCintura($cintura) {
            $this->cintura = $cintura;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getClienteid() {
            return $this->cliente_id;
        }

        public function setClienteid($cliente_id) {
            $this->cliente_id = $cliente_id;
        }

        public function inserir(){
            $sql = 'INSERT INTO medidas (altura, busto, quadril, ombro, ombro_c, larg_omb, comp_s, manga_comp, punho, cintura, cliente_id, tipo) 
            VALUES (:altura, :busto, :quadril, :ombro, :ombro_c, :larg_omb, :comp_s, :manga_comp, :punho, :cintura, :cliente_id, :tipo)';
            $parametros = array(":altura"=>$this->getAltura(),
                                ":busto"=>$this->getBusto(),
                                ":quadril"=>$this->getQuadril(),
                                ":ombro"=>$this->getOmbro(),
                                ":ombro_c"=>$this->getOmbroc(),
                                ":larg_omb"=>$this->getLargomb(),
                                ":comp_s"=>$this->getComps(),
                                ":manga_comp"=>$this->getMangacomp(),
                                ":punho"=>$this->getPunho(),
                                ":cintura"=>$this->getCintura(),
                                ":cliente_id"=>$this->getClienteid(),
                                ":tipo"=>$this->getTipo());
            return parent::executaComando($sql, $parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM medidas WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE medidas 
            SET altura = :altura, busto = :busto, quadril = :quadril, ombro = :ombro, ombro_c = :ombro_c, larg_omb = :larg_omb, comp_s = :comp_s, manga_comp = :manga_comp, punho = :punho, cintura = :cintura, cliente_id = :cliente_id, tipo = :tipo
            WHERE id = :id';
            $parametros = array(":altura"=>$this->getAltura(),
                                ":busto"=>$this->getBusto(),
                                ":quadril"=>$this->getQuadril(),
                                ":ombro"=>$this->getOmbro(),
                                ":ombro_c"=>$this->getOmbroc(),
                                ":larg_omb"=>$this->getLargomb(),
                                ":comp_s"=>$this->getComps(),
                                ":manga_comp"=>$this->getMangacomp(),
                                ":punho"=>$this->getPunho(),
                                ":cintura"=>$this->getCintura(),
                                ":cliente_id"=>$this->getClienteid(),
                                ":tipo"=>$this->getTipo(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM medidas";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE altura like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE busto like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE quadril like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE ombro like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE ombro_c like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(7): $sql .= " WHERE larg_omb like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(8): $sql .= " WHERE comp_s like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(9): $sql .= " WHERE manga_comp like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(10): $sql .= " WHERE punho like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(11): $sql .= " WHERE cintura like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(12): $sql .= " WHERE cliente_id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(13): $sql .= " WHERE tipo like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM medidas";
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
            $sql = "SELECT * FROM medidas WHERE id = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>