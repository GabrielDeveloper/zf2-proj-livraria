<?php

namespace Bible\Model;

class PlanosService {
    
    protected $planosTable;
    
    public function __construct(PlanosTable $table) {
        $this->planosTable = $table;
    }
    
    public function fetchAll() {
        $resultset = $this->planosTable->select();
        return $resultset;
    }
    
    public function insert(Array $data){
        $result = $this->planosTable->insert($data);
        return $result;
    }
}
