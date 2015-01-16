<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        $livros = $this->getServiceLocator()->get('Livraria\Model\LivroService');
        if($this->params()->fromQuery('cat_id')){
            (object) $livros = $livros->selectByCategory($this->params()->fromQuery('cat_id'));
        } else {
            $livros = $livros->fetchAll();
        }
        $categorias = $this->getServiceLocator()->get('Livraria\Model\CategoriaService');
        $categorias = $categorias->fetchAll();
        return new ViewModel(['livros'=>$livros, 'categorias'=>$categorias]);
    }
    
    public function detalhesAction(){
        $livros = $this->getServiceLocator()->get('Livraria\Model\LivroService');
        $livros = $livros->selectById($this->params()->fromRoute('livro'));
        $cat = $this->getCatById()->selectById($livros['liv_cat_id']);
        $livros['liv_cat_id'] = $cat['cat_title'];
         return new ViewModel(['livro'=>$livros]);
    }
    
    public function compraAction(){
        $livros = $this->getServiceLocator()->get('Livraria\Model\LivroService');
        $livros = $livros->selectById($this->params()->fromRoute('livro'));
        $cat = $this->getCatById()->selectById($livros['liv_cat_id']);
        $livros['liv_cat_id'] = $cat['cat_title'];
         return new ViewModel(['livro'=>$livros]);
    }
    
    public function statusAction(){
        return new ViewModel();
    }

    public function getCatById(){
        $catCervice = $this->getServiceLocator()->get('Livraria\Model\CategoriaService');
        return $catCervice;
    }
}
