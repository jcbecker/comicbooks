<?php 
class Obra{
    private $id;
    private $titulo;
    private $autor;
    private $editora;
    private $datal;
    private $datap;
    private $tipo;
    private $pdf;
    private $capa;
    
    function __construct($id,$titulo,$autor,$editora,$datal,$datap,$tipo,$pdf,$capa){
        $this->id=$id;
        $this->titulo=$titulo;
        $this->autor=$autor;
        $this->editora=$editora;
        
        
        $d=explode("-",$datal);
        $this->datal=$d[0];
        
        $d=explode(" ",$datap);
        $data=explode("-",$d[0]);
        $this->datap=$data[2].'/'.$data[1].'/'.$data[0].' às '.$d[1];
        
        $this->tipo=$tipo;
        $this->pdf=$pdf;
        $this->capa=$capa;
        
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    
    
    
}





?>
