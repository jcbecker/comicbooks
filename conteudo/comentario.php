<?php 
class Comentario{
    private $user;
    private $obra;
    private $horario;
    private $texto;
    
    function __construct($user,$obra,$horario,$texto){
        $this->user=$user;
        $this->obra=$obra;
        $this->texto=$texto;
        
        
        
        $d=explode(" ",$horario);
        $data=explode("-",$d[0]);
        $this->horario=$data[2].'/'.$data[1].'/'.$data[0].' às '.$d[1];
        
        
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    
    
    
}





?>
