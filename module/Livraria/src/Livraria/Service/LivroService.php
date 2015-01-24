<?php

namespace Livraria\Model;

use Zend\Validator\File\Size,
    Zend\File\Transfer\Adapter\Http;

class LivroService {
    
    protected $livroTable;
    
    public function __construct(LivroTable $livrotable) {
        $this->livroTable = $livrotable;
    }
    
    public function fetchAll(){
        $select = $this->livroTable->select();
        return $select;
    }
    
    public function selectById($id){
        
        $where = ['liv_id'=>(int)$id];
        $select = $this->livroTable->select($where);
        foreach ($select as $dados){
            $data = (array) $dados;
        }
        return $data;
    }
    
    public function selectByCategory($category){
        $where = ['liv_cat_id'=>$category];
        $select = $this->livroTable->select($where);
        foreach ($select as $dados){
            $data[] = (array) $dados;
        }
        return $data;
    }
    
    public function insertData(Array $data, Array $file = null){
        unset($data['submit']);
        $data = array_merge($data, ['liv_img'=>$file['name']]);
        if($this->insertFile($file, $data['liv_img_url'])){
            $data['liv_img_url'] = 'image/livros/'.$data['liv_img'];
            $insert = $this->livroTable->insert($data);
        }
        return $insert;
    }
    
    public function insertFile($file, $destination){
        $size = new Size(['max'=>2000000]);
        $adapter = new Http();
        $adapter->setValidators([$size], $file['name']);
        
        if($adapter->isValid()){
            $adapter->setDestination($destination);
            if($adapter->receive($file['name'])){
                return true;
            }
        }
    }
    
    public function updateData(Array $data, Array $file = null){
        unset($data['submit']);
        $where = ['liv_id'=>(int)$data['liv_id']];
        
        if(isset($file)){
            $data = array_merge($data, ['liv_img'=>$file['name']]);
            if($this->insertFile($file, $data['liv_img_url'])){
                $data['liv_img_url'] = "image/livros/".$data['liv_img'];
            }
        }
        $this->livroTable->update($data, $where);
    }

    public function deleteData($id){
        $select = $this->selectById($id);
        if(!is_null($select['liv_img'])){
            if(file_exists("./public/".$select['liv_img_url'])){
                unlink(".public/".$select['liv_img_url']);
            }else {
                echo "NAO ACHOU http://".$_SERVER['HTTP_HOST']."/".$select['liv_img_url'];die;
            }
        }
        $where = ['liv_id'=>(int)$id];
        $this->livroTable->delete($where);
    }
    
    
}
