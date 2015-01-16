<?php

namespace LivrariaAdmin;

trait CategoriaTrait {
    
    protected $categorias;


    protected function getCategoriaId(){
        $cat = $this->categorias->fetchAll();
        foreach ($cat as $categorias){
            $id[] = $categorias->getId();
        }
        return $id;
    }
    
    protected function getCategoriaName(){
        $cat = $this->categorias->fetchAll();
        foreach ($cat as $categorias){
            $name[] = $categorias->getTitle();
        }
        return $name;
    }
    
    public function setCategorias($categorias){
        $this->categorias = $categorias;
    }
}
