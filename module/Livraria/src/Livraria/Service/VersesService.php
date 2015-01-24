<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Service;

use Zend\Db\Sql\Sql;

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
            'book'=>    $data['book'],
            'chapter'=> $data['chapter'],
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
    
    public function selectDistinctChapter($data){
        
        $where = [
            'book'=>  $data,
        ];
        
        $sql = new Sql($this->versesTable->getAdapter());
        $st = $sql->select($this->versesTable->getTable());
        $st->columns(['chapter']);
        $st->where($where);
        $st->quantifier('DISTINCT');
        $stm = $sql->prepareStatementForSqlObject($st);
        $res = $stm->execute();
        
        return $res->count();
    }
    
}
