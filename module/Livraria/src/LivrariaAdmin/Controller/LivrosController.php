<?php

namespace LivrariaAdmin\Controller;


use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use LivrariaAdmin\Form\LivroForm;

class LivrosController extends AbstractActionController{
    
    protected $livroForm;


    public function indexAction() { 
        
        $livroTable = $this->getLivroService()->fetchAll();
        foreach ($livroTable as $liv){
            $cat = $this->getCatById()->selectById($liv->liv_cat_id);
            $liv->liv_cat_id = $cat['cat_title'];
            $livros[] = $liv;
        }
        return new ViewModel(['livros'=>$livros]);
    }
    
    public function formAction(){
        $livroTable = $this->getLivroService();
        $this->setLivroForm($this->getLivroForm());
        if($this->params('id')){
            $data = $livroTable->selectById($this->params('id'));
        }
        
        return new ViewModel(['livroForm'=>  $this->livroForm, 'data'=>$data]);
    }
    
    public function addAction(){
        $livroTable = $this->getLivroService();
        $this->setLivroForm($this->getLivroForm());
        $data = $this->params()->fromPost();
        $file = $this->params()->fromFiles('liv_img');
        
        if($this->params()->fromPost('liv_id') > 0){
            if(empty($file['name'])){
                unset($file);
            } else {
                $data['liv_img_url'] = $this->getRequest()->getServer()->DOCUMENT_ROOT.'/image/livros';
            }
            $this->livroForm->setData($data);
            $livroTable->updateData($data, (isset($file) ? $file : null));
            $this->redirect()->toRoute('livraria-admin', ['controller'=>'livros']);
            
        } else {
            
            $data['liv_img_url'] = $this->getRequest()->getServer()->DOCUMENT_ROOT.'/image/livros';
            
            if($this->getRequest()->isPost()){
                $this->livroForm->setData($data);
                if($this->livroForm->isValid()){
                    $livroTable->insertData($data, $file);
                    $this->redirect()->toRoute('livraria-admin', ['controller'=>'livros']);
                } else {
                    $invalidView = new ViewModel();
                    $invalidView->setTemplate('livraria-admin/livros/invalid.phtml');
                    return $invalidView;
                }
            }
        }        
    }
    
    public function deleteAction(){
        $livroTable = $this->getLivroService();
        $this->setLivroForm($this->getLivroForm());
        $id = $this->params('id');
        
        $livroTable->deleteData($id);
        $this->redirect()->toRoute('livraria-admin', ['controller'=>'livros']);
        
    }

    public function setLivroForm($livroForm){
        $this->livroForm = $livroForm;
    }
    
    public function getLivroForm(){
        return $this->getServiceLocator()->get('LivrariaAdmin\Factory\LivroForm');
    }
    
    public function getLivroService(){
        return $this->getServiceLocator()->get('Livraria\Model\LivroService');
    }
    
    public function getCatById(){
        $catCervice = $this->getServiceLocator()->get('Livraria\Model\CategoriaService');
        return $catCervice;
    }

    
}
