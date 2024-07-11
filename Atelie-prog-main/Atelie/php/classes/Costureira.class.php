<?php
        include_once "../../php/utils/autoload.php";
        class Costureira extends Database{
        private $id;
        private $nome;
        private $email;
        private $senha;

        public function __construct($id, $nome, $email, $senha) {
            $this->setId($id);
            $this->setnome($nome);
            $this->setemail($email);
            $this->setsenha($senha);
        }  

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getnome() {
            return $this->nome;
        }

        public function setnome($nome) {
            $this->nome = $nome;
        }
        
        public function getemail() {
            return $this->email;
        }

        public function setemail($email) {
            $this->email = $email;
        }

        public function getsenha() {
            return $this->senha;
        }

        public function setsenha($senha) {
            $this->senha = $senha;
        }

        public function inserir(){
            $sql = 'INSERT INTO costureira (nome, email, senha) 
            VALUES (:nome, :email, :senha)';
            $parametros = array(":nome"=>$this->getnome(),
                                ":email"=>$this->getemail(),
                                ":senha"=>$this->getsenha());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM costureira WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE costureira 
            SET nome = :nome, email = :email, senha = :senha
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getnome(),
                                ":email"=>$this->getemail(),
                                ":senha"=>$this->getsenha(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM costureira";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE email like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE senha like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM costureira";
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

        public static function efetuarLogin($email, $senha){
            $sql = "SELECT id, nome FROM costureira WHERE email = :email AND senha = :senha";
            $parametros = array(
                ':email' => $email,
                ':senha' => $senha,
            );
            session_set_cookie_params(0);
            session_start();
            if (self::buscar($sql, $parametros)) {
                $_SESSION['id'] = self::buscar($sql, $parametros)[0]['id'];
                $_SESSION['nome'] = self::buscar($sql, $parametros)[0]['nome'];
                return true;
            } else {
                $_SESSION['id'] = "";
                $_SESSION['nome'] = "";
                return false;
            }
        }
    }
?>