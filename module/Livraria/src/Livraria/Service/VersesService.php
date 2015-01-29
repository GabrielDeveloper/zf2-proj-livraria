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
        
        if (strpos($data['vd_versiculos'], ',')){
            $ver = explode(',', $data['vd_versiculos']);
            foreach ($ver as $v){
                if(strpos($v, '-')){
                    $n = explode('-',$v);
                    //verifica se o segundo versiculo é o proximo do primeiro
                    if(($n[0]+1) !== $n[1]){
                        for($i=$n[0];$i<=$n[1];$i++){
                            $versiculo[] = $i; 
                        }
                    }
                }else {
                    $versiculo[] = $v;
                }
            }
        } else{
            $versiculo = $data['vd_versiculos'];
        }
        
        $where = [
            'book'=>    $data['vd_livro'],
            'chapter'=> $data['vd_capitulo'],
            'version'=>'aa',
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
            'version'=> $data['version'],
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
