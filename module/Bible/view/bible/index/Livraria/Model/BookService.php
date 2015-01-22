<?php

namespace Livraria\Model;


class BookService {
    
    protected $bookTable;
    
    public function __construct(BookTable $table) {
        $this->bookTable = $table;
    }
    
    public function fetchAll(){
        $dado = $this->bookTable->select();
        foreach ($dado as $dt){
            $data[] = $dt;
        }
        
        return $data;
    }
    
    public function selectByName($name){
        $where = ['name'=>  $name];
        $dado = $this->bookTable->select($where);
        foreach ($dado as $dt){
            $data[] = $dt;
        }
        return $data;
    }
    
}