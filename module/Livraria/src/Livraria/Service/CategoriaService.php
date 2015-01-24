<?php

namespace Livraria\Service;

use Zend\Validator\File\Size,
    Zend\File\Transfer\Adapter\Http;

use Livraria\Model\CategoriaTable;

class CategoriaService {
    
    protected $categoriaTable;
    
    public function __construct(CategoriaTable $table) {
        $this->categoriaTable = $table;
    }
    
    public function fetchAll(){
        return $this->categoriaTable->select();
    }
    
    public function selectById($id){
        
        if(is_numeric($id)){
            $where = ['cat_id'=>(int)$id];
        }
        $select = $this->categoriaTable->select($where);
        
        foreach ($select as $dados){
            $data = (array) $dados;
        }
        return $data;
    }
    
    public function insertData(Array $data, Array $file = null){
        
        unset($data['submit']);
        $data = array_merge($data, ['cat_img'=>$file['name']]);
        if($this->insertFile($file, $data['cat_img_url'])){
            $data['cat_img_url'] = "image/categorias/".$data['cat_img'];
            $insert = $this->categoriaTable->insert($data);    
        }
        return $insert;
    }
    
    public function updateData(Array $data, Array $file = null){
        
        unset($data['submit']);
        $where = ['cat_id'=>(int)$data['cat_id']];
        
        if(isset($file)){
            $data = array_merge($data, ['cat_img'=>$file['name']]);
            if($this->insertFile($file, $data['cat_img_url'])){
                $data['cat_img_url'] = "image/categorias/".$data['cat_img'];
            }
        }
        #var_dump($data);
        $this->categoriaTable->update($data, $where);
    }
    
    public function insertFile(Array $file, $destination){
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
    
    public function deleteData($id){
        $select = $this->selectById($id);
        if(!is_null($select['cat_img'])){
            if(file_exists("./public/".$select['cat_img_url'])){
                unlink("./public/".$select['cat_img_url']);
            }else{
                echo "NAO ACHOU http://".$_SERVER['HTTP_HOST']."/".$select['cat_img_url'];die;
            }
        }
        $where = ['cat_id'=>$select['cat_id']];
        $this->categoriaTable->delete($where);
    }
    
}
