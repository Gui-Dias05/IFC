<?php
class Calculadora{
    private $ip;
    private $cidr;

    public function __construct($ip, $cidr) {
        $this->setIp($ip);
        $this->setCidr($cidr);
    }
    
    public function getIp() {
        return $this->ip;
    }

    public function getCidr() {
        return $this->cidr;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }
    
    public function setCidr($cidr) {
        $this->cidr = $cidr;
    }
    
    public function __toString(){
        $str = "<br>[Resultado]<br><br>".
                "IPv4: ".$this->getIp()."<br><br>".
                "IPv4 binário: ".$this->transformarEmBinario($this->getIp())."<br><br>".
                "CIDR:/".$this->getCidr()."<br><br>".
                "Máscara:". $this->mascaraDeRedeDecimal()."<br><br>".
                "Máscara binária: ".$this->mascaraDeRedeBinario()."<br><br>".
                "Endereço de rede: ".$this->redeDecimal()."<br><br>".
                "Endereço de rede binário: ".$this->redeBinario()."<br><br>".
                "Primerio utilizável: ".$this->primeiroEnderecoUtilizavelDecimal()."<br><br>".
                "Primerio utilizável binário: ".$this->primeiroEnderecoUtilizavelBinario()."<br><br>".
                "Último utilizável: ".$this->ultimoEnderecoDecimal()."<br><br>".
                "Último utilizável binário: ".$this->ultimoEnderecoBinario()."<br><br>".
                "Endereço de broadcast: ".$this->broadcastDecimal()."<br><br>".
                "Endereço de broadcast binário: ".$this->broadcastBinario()."<br>";
        return $str;
    }

    // long2ip --> decimal para ip
    // ip2long --> ip para decimal
    // 32 é a quantidade de bits

    // função para transformar para binário
    // str_pad --> Preenche uma string para um certo tamanho com outra string
    // str_split --> Converte uma string para um array
    // decbin --> Decimal para binário
    public function transformarEmBinario($ip) {
        // Adiciona zero a esquerda até chegar em 32 bits
        $ipBin = str_pad(decbin(ip2long($ip)), 32, '0', STR_PAD_LEFT);
        return implode(".", str_split($ipBin, 8));
    }

    // Cidr --> Número de bits --> é a sigla para Classes Inter-Domain Routing, e ele é considerado um método para repartir os endereços IP e para rotear
    // bindec --> decimal para binário
    public function mascaraDeRedeDecimal() {
        $bin = null;
        //Coloca 1 até chegar no número de bits da página --> ?
        for ($i = 1; $i <= 32; $i ++){
            $bin .= $this->getCidr() >= $i ? '1' : '0';
        }
        //transforma de decimal para ip e depois de binário para decimal
        $mascara = long2ip(bindec($bin));
        return $mascara;
    }

    //Mesma coisa que o decimal, porém transformando em binário no fim
    public function mascaraDeRedeBinario() {
        $bin = null;
        for ($i = 1; $i <= 32; $i ++){
            $bin .= $this->getCidr() >= $i ? '1' : '0';
        }
        $mascara = long2ip(bindec($bin));
        //transforma a máscara de rede em binário
        return $this->transformarEmBinario($mascara);
    }

    //Para descobrir o endereço de rede
    public function redeDecimal() {
        // Pegando por exemplo o ip
        //IP:        00001111.00000000.00000000.00000001
        //MÁSCARA:   11111111.00000000.00000000.00000000
        //RESULTADO: 00001111.00000000.00000000.00000000
        // 0 com 0 = 0
        // 0 com 1 = 0
        // 1 com 0 = 0
        // 1 com 1 = 1
        $enderecoDeRede = long2ip((ip2long($this->getIp())) & ip2long($this->mascaraDeRedeDecimal()));
        return $enderecoDeRede;
    }

    //Mesma coisa que o anterior apenas convertendo para binário
    public function redeBinario() {
        $enderecoDeRede = long2ip((ip2long($this->getIp())) & ip2long($this->mascaraDeRedeDecimal()));
        //Convertendo para binário
        return $this->transformarEmBinario($enderecoDeRede);
    }

    //Calculo do primeiro endereço utilizável
    public function primeiroEnderecoUtilizavelDecimal() {
        //Endereço de rede e somei 1
        $primeiroEnderecoUtilizavel = long2ip(ip2long($this->redeDecimal()) + 1);
        return $primeiroEnderecoUtilizavel;
    }

    //Mesma coisa que o anterior só que transformando em binário
    public function primeiroEnderecoUtilizavelBinario() {
        $primeiroEnderecoUtilizavel = long2ip(ip2long($this->redeDecimal()) + 1);
        //Conversão para binário
        return $this->transformarEmBinario($primeiroEnderecoUtilizavel);
    }

    public function broadcastDecimal() {
        //Máscara de bit curinga é uma máscara que indica quais partes do endereço IP estão disponíveis para exame
        $curinga=long2ip(~ip2long($this->mascaraDeRedeDecimal()));
        //Pegando o IP 10.0.0.1 e a máscara 255.0.0.0
        // IP:              00001010.00000000.00000000.00000001
        // Máscara curinga: 00000000.11111111.11111111.11111111
        // Resultado:       00001010.11111111.11111111.11111111
        // Sendo:           10.255.255.255
        // 1 com 1 = 1
        // 1 com 0 = 1
        // 0 com 1 = 1
        // 0 com 0 = 0
        $endereçoBroadcast = long2ip(ip2long($this->getIp()) | ip2long($curinga) );
        // Vai modificar se tá zero vai para 1 e se estiver 1 vai para 0 --> |
        return $endereçoBroadcast;
    }

    //Mesma coisa que o de antes só que transformando para binário
    public function broadcastBinario() {
        $curinga=long2ip(~ip2long($this->mascaraDeRedeDecimal()));
        $endereçoBroadcast = long2ip(ip2long($this->getIp()) | ip2long($curinga) );
        //Conversão para binário
        return $this->transformarEmBinario($endereçoBroadcast);
    }

    // Calculo do último endereço utilizável
    public function ultimoEnderecoDecimal() {
        //Pega o broadcast decimal e diminui 1
        $ultimoEnderecoUtilizavel = long2ip(ip2long($this->broadcastDecimal()) - 1);
        return $ultimoEnderecoUtilizavel;
    }

    // Mesma coisa que o de antes, porém transformando para binário
     public function ultimoEnderecoBinario() {
        $ultimoEnderecoUtilizavel = long2ip(ip2long($this->broadcastDecimal()) - 1);
        //Conversão para binário
        return $this->transformarEmBinario($ultimoEnderecoUtilizavel);
    }
}
?>