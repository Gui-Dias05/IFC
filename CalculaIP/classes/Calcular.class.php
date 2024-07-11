<?php
class Calcular{
    private $ip;
    private $cidr;

    public function __construct($ip, $cidr) {
        $this->setIp($ip);
        $this->setCidr($cidr);
    }
    
    public function getIp() { return $this->ip;}

    public function setIp($ip) { $this->ip = $ip;}

    public function getCidr() { return $this->cidr;}
    
    public function setCidr($cidr) { $this->cidr = $cidr;}
    
    public function __toString(){
        $str = "IPv4: ".$this->getIp()."<br>".
                "IPv4 binário: ".$this->formaBinaria($this->getIp())."<br>".
                "CIDR: /".$this->getCidr()."<br>".
                "Máscara: ". $this->MRdecimal()."<br>".
                "Máscara binária: ".$this->MRbin()."<br>".
                "Endereço de rede: ".$this->redeDec()."<br>".
                "Endereço de rede binário: ".$this->redeBinario()."<br>".
                "Primerio utilizável: ".$this->priEndDecimal()."<br>".
                "Primerio utilizável binário: ".$this->priEndBinario()."<br>".
                "Último utilizável: ".$this->ultEndDecimal()."<br>".
                "Último utilizável binário: ".$this->ultEndBinario()."<br>".
                "Endereço de broadcast: ".$this->broadDec()."<br>".
                "Endereço de broadcast binário: ".$this->broadcastBinario()."<br>";
        return $str;
    }

    public function formaBinaria($ip) {
        $ipBin = str_pad(decbin(ip2long($ip)), 32, '0', STR_PAD_LEFT);
        return implode(".", str_split($ipBin, 8));
    }

    public function MRdecimal() {
        $bin = null;
        for ($i = 1; $i <= 32; $i ++){
            $bin .= $this->getCidr() >= $i ? '1' : '0';
        }
        $mascara = long2ip(bindec($bin));
        return $mascara;
    }

    public function MRbin() {
        $bin = null;
        for ($i = 1; $i <= 32; $i ++){
            $bin .= $this->getCidr() >= $i ? '1' : '0';
        }
        $mascara = long2ip(bindec($bin));
        return $this->formaBinaria($mascara);
    }

    public function redeDec() {
        $endRede = long2ip((ip2long($this->getIp())) & ip2long($this->MRdecimal()));
        return $endRede;
    }

    public function redeBinario() {
        $endRede = long2ip((ip2long($this->getIp())) & ip2long($this->MRdecimal()));
        return $this->formaBinaria($endRede);
    }

    public function priEndDecimal() {
        $priEnd = long2ip(ip2long($this->redeDec()) + 1);
        return $priEnd;
    }

    public function priEndBinario() {
        $priEnd = long2ip(ip2long($this->redeDec()) + 1);
        return $this->formaBinaria($priEnd);
    }

    public function broadDec() {
        $brd =long2ip(~ip2long($this->MRdecimal()));
        $endBroad = long2ip(ip2long($this->getIp()) | ip2long($brd) );
        return $endBroad;
    }

    public function broadcastBinario() {
        $brd=long2ip(~ip2long($this->MRdecimal()));
        $endBroad = long2ip(ip2long($this->getIp()) | ip2long($brd) );
        return $this->formaBinaria($endBroad);
    }

    public function ultEndDecimal() {
        $ultEndUtil = long2ip(ip2long($this->broadDec()) - 1);
        return $ultEndUtil;
    }

     public function ultEndBinario() {
        $ultEndUtil = long2ip(ip2long($this->broadDec()) - 1);
        return $this->formaBinaria($ultEndUtil);
    }
}
?>