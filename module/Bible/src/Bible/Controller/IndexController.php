<?php

namespace Bible\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Session\Container;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        $books = $this->getServiceBook();
        $livro = $books->fetchAll();
        
        $verse = $this->getVersiculoDia();        
        
        //die();
        return new ViewModel(['planos'=>$livro, 'data'=>$verse]);
    }
    
    public function readAction(){
        
        $books = $this->getServiceBook();
        $verses = $this->getServiceVerses();
        $session = new Container('book');
        
        $book = $this->params()->fromPost('button');
        $chapter = $this->params()->fromPost('chapter');
        $totalChapter = $verses->selectDistinctChapter($book);
        $version = $this->params()->fromPost('version');
        //if($book!=null || $chapter!=null || $version!=null){
            $reading['book'] = $book==null?$session->book['book']:$book;
            $nameBook = $books->selectById($reading['book']);
            $reading['nameBook'] = $nameBook;
            $reading['version'] = $version==null?'aa':$version;
            $reading['chapter'] = $chapter==null?1:$chapter;
            $reading['totalChapters'] = $totalChapter==null?$session->book['totalChapters']:$totalChapter;
            $session->book = $reading;
        //}
        
        $versos = $verses->selectChapter($reading);
        
        return new ViewModel(['book'=>$session->book, 'verses'=>$versos]);
    }
    
    public function bibleVersionAction(){
        $versos = $this->getServiceLocator()->get('Bible\Factory\BibleVersion');
        return new ViewModel(['versos'=>$versos]);
    }
    
            
    public function versionAction(){
        
        return $this->redirect()->toRoute('bible-home', ['controller'=>'index', 'action'=>'read','version'=>$version]);
    }
    
    
    protected function getServiceBook(){
        return $this->serviceLocator->get('Livraria\Service\BookService');
    }
    
    protected function getServiceVerses(){
        return $this->serviceLocator->get('Livraria\Service\VersesService');
    }
    
    public function getVersiculoDia(){
        $data = $this->serviceLocator->get('LivrariaAdmin\Factory\VersiculoDia');        
        $verse = $this->serviceLocator->get('Livraria\Service\VersesService');
        return $verse->selectVerses($data);
    }
}
