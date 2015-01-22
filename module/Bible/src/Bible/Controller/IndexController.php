<?php

namespace Bible\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Session\Container;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        $books = $this->getServiceBook();
        $livro = $books->fetchAll();
        
        //die();
        return new ViewModel(['planos'=>$livro]);
    }
    
    public function readAction(){
        
        $books = $this->getServiceBook();
        $verses = $this->getServiceVerses();
        $session = new Container('book');
        
        $book = $this->params()->fromPost('button');
        $chapter = $this->params()->fromPost('chapter');
        $totalChapter = $verses->selectDistinctChapter($book);
        
        
        if($book!=null || $chapter!=null){
            $reading['book'] = $book==null?$session->book['book']:$book;
            $nameBook = $books->selectById($reading['book']);
            $reading['nameBook'] = $nameBook;
            
            $reading['chapter'] = $chapter==null?1:$chapter;
            $reading['totalChapters'] = $totalChapter==null?$session->book['totalChapters']:$totalChapter;
            $session->book = $reading;
        }
        
        $versos = $verses->selectChapter($reading);
        
        return new ViewModel(['book'=>$session->book, 'verses'=>$versos]);
    }
    
    protected function getServiceBook(){
        return $this->serviceLocator->get('Livraria\Model\BookService');
    }
    
    protected function getServiceVerses(){
        return $this->serviceLocator->get('Livraria\Model\VersesService');
    }
}
