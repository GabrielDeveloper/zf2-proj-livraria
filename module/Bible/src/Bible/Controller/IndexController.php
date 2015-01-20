<?php

namespace Bible\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
 Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        
        $select = [
            'vd_livro'=>'1',
            'vd_capitulo'=>1
        ];
        $planosService = $this->getServiceLocator()->get("Livraria\Model\VersesService");
        //$planosService->insert(['nome'=>'Testando Insert']);
        $planos = $planosService->selectChapter($select);
        
        $page = $this->params()->fromRoute('page');
        
        $paginator = new Paginator(new ArrayAdapter($planos));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(1);
        
        return new ViewModel(['planos'=>$planos, 'page'=>$page]);
    }
    
    public function readAction(){
        $books = $this->getServiceBook();
        $livro = $books->fetchAll();
        
        $book = $this->params()->fromPost('button');
        var_dump($book);
        //die();
        
        
        return new ViewModel(['planos'=>$livro]);
    }
    
    protected function getServiceBook(){
        return $this->serviceLocator->get('Livraria\Model\BookService');
    }
    
    protected function getServiceVerses(){
        return $this->serviceLocator->get('Livraria\Model\VersesService');
    }
}
