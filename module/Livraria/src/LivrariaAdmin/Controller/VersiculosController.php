<?php


namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;


class VersiculosController extends AbstractActionController{
    
    public function indexAction(){
        
        $data = $this->getVersiculoDia();        
        $verse = $this->getServiceVerses()->selectVerses($data);
        if($this->flashMessenger()->hasMessages()){
            $msg = $this->flashMessenger()->getMessages();
        }
        return new ViewModel(['data'=>$verse, 'msg'=>$msg]);
    }
    
    public function salvarAction(){
        $data = $this->getVersiculoDia();
        $versiculo = $this->getServiceVersiculoDia();
        var_dump($versiculo);
        if($versiculo == false){
            $msg = '<div class="alert alert-success" role="alert"> Nenhum versículo foi selecionado! Url Not Found</div>';
        }else {
            $msg = $versiculo->insertData($data);
        }
        $this->flashMessenger()->addMessage($msg);
        $return = $this->redirect()->toRoute('livraria-admin',['controller'=>'versiculos']);
        return $return;
        
        
    }
    
    protected function getServiceVersiculoDia(){
        return $this->serviceLocator->get('Livraria\Service\VersiculoService');
    }
    
    protected function getServiceBook(){
        return $this->serviceLocator->get('Livraria\Service\BookService');
    }
    
    protected function getServiceVerses(){
        return $this->serviceLocator->get('Livraria\Service\VersesService');
    }
    
    public function getVersiculoDia(){
        return $this->serviceLocator->get('LivrariaAdmin\Factory\VersiculoDia');
    }
    
    function codificacao($string) {
        return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
    }
}


