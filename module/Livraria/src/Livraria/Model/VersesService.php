<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Model;


class VersesService {

    protected $versesTable;
    
    public function __construct($table) {
        $this->versesTable = $table;
    }
    
    public function selectVerses(Array $data){
        if(strpos($data['vd_versiculos'], '-')){
            $versiculo = explode('-', $data['vd_versiculos']);
        } else{
            $versiculo = $data['vd_versiculos'];
        }
        
        $where = [
            'book'=>    $data['vd_livro'],
            'chapter'=> $data['vd_capitulo'],
        ];
        if($versiculo!=null){
           $where['verse'] = $versiculo;
        }
        $select = $this->versesTable->select($where);
        foreach ($select as $dt){
            $text[] = $dt->text;
        }
        $texto = implode(' ', $text);
        
        return $texto."<br>".$data['vd_ref'];
    }
    
    public function selectChapter(Array $data){
        $where = [
            'book'=>    $data['vd_livro'],
            'chapter'=> $data['vd_capitulo'],
        ];
        
        $select = $this->versesTable->select($where);
        foreach ($select as $dt){
            $text[] = $dt->text;
        }
        
        return $text;
    }
    
    public function selectBook(Array $data){
        $where = [
            'book'=>    $data['vd_livro'],
        ];
        
        $select = $this->versesTable->select($where);
        foreach ($select as $dt){
            $text[] = $dt->text;
        }
        
        return $text;
    }
    
    public function selectDistinctChapter(){
        
        $where = [
            'book'=>    1,
        ];
        /*
        $this->versesTable->setColumns(['chapter']);
        $this->versesTable->setQuantifier('DISTINCT');
        $select = $this->versesTable->select($where);
        foreach ($select as $dt){
            $text[] = $dt;
        }
        
        var_dump($text);
        
        return $text;
        $select = $this->versesTable;
        $select->select($where);
        foreach ($select as $dt){
            $text[] = $dt;
        }
        */
        $sql = new \Zend\Db\Sql\Sql($this->versesTable->getAdapter());
        $st = $sql->select($this->versesTable->getTable());
        $st->columns(['chapter']);
        $st->where($where);
        $st->quantifier('DISTINCT');
        $stm = $sql->prepareStatementForSqlObject($st);
        $res = $stm->execute();
        
        var_dump($res);
        
        
        die;
    }
    
}