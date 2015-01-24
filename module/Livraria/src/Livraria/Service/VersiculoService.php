<?php

namespace Livraria\Service;

use Livraria\Model\VersiculoTable;

class VersiculoService {
    
    protected  $versiculoTable;
    
    public function __construct(VersiculoTable $table) {
        $this->versiculoTable = $table;
    }
    
    public function insertData(Array $data){
        
        unset($data['vd_date']);
        $versiculos = $this->selectVerExistente($data);        
        foreach ($versiculos as $value){
            $versiculo = $value;
        }
        if(!$versiculo){
            $data['vd_date'] = date('d/m/Y');
            $this->versiculoTable->insert($data);
            $msg = '<div class="alert alert-success" role="alert"> Versiculo inserito na tabela : "'.$this->versiculoTable->getTable().'"</div>';
        }else {
            $msg = '<div class="alert alert-danger" role="alert"> O versículo já existe na tabela : "'.$this->versiculoTable->getTable().'"</div>';
        }
        return $msg;
    }
    
    public function selectVerExistente($data){
        return $this->versiculoTable->select($data);
    }
    
    public function selectAll(){
        
        $dados =  $this->versiculoTable->select();
        foreach ($dados as $dt){
            $data[] = $dt;
        }
        return $data;
    }
    
}
