<?php

namespace Bible\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
 Zend\Paginator\Adapter\ArrayAdapter,
 Zend\Session\Container;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        $books = $this->getServiceBook();
        $livro = $books->fetchAll();
        
        $session = new Container('book');
        $book = $this->params()->fromPost('button');
        
        if($book!=null){
            $reading['book'] = $book+1;
            $reading['chapter'] = 1;
            $session->book = $reading;
        }
        //die();
        return new ViewModel(['planos'=>$livro, 'book'=>$session->book]);
    }
    
    public function readAction(){
        $books = $this->getServiceVerses();
        $session = new Container('book');
        
        $livro = $books->selectDistinctChapter();
        
        $book = $this->params()->fromPost('button');
        
        //var_dump($session->book);
        //die();
        
        
        return new ViewModel(['book'=>$session->book]);
    }
    
    protected function getServiceBook(){
        return $this->serviceLocator->get('Livraria\Model\BookService');
    }
    
    protected function getServiceVerses(){
        return $this->serviceLocator->get('Livraria\Model\VersesService');
    }
}
