<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
 Zend\View\Model\ViewModel;
use LivrariaAdmin\Form\PostForm;

class CategoriasController extends AbstractActionController{
    
    private $postForm;
    
    public function indexAction() {
        $categorias = $this->getCatService()->fetchAll();
        return new ViewModel(['categorias'=>$categorias]);
    }
    
    
    public function formAction(){
        $categoriaTable = $this->getCatService();
        $this->setPostForm($this->getForm());
        
        if($this->params('id')){
            $data = $categoriaTable->selectById($this->params('id'));
            $this->postForm->setData($data);
        }        
        $viewModel = new ViewModel(['data'=>$data, 'postForm'=>$this->postForm]);
        return $viewModel;
    }
    
    public function addAction(){
        
        $categoriaTable = $this->getCatService();
        $this->setPostForm($this->getForm());
        $data = $this->params()->fromPost();
        $file = $this->params()->fromFiles('cat_img');
        
        if($this->params()->fromPost('cat_id') > 0){
           
            if(empty($file['name'])){
               unset($file);
            } else {
               $data['cat_img_url'] = $this->getRequest()->getServer()->DOCUMENT_ROOT.'image/categorias';
            }
            
            $this->postForm->setData($data);
            $categoriaTable->updateData($data, (isset($file) ? $file : null));
            $this->redirect()->toRoute('livraria-admin');
            
        } else{
            
            $data['cat_img_url'] = $this->getRequest()->getServer()->DOCUMENT_ROOT.'/image/categorias';

            if($this->getRequest()->isPost()){
                $this->postForm->setData($data);
                if($this->postForm->isValid()){
                    $categoriaTable->insertData($data, $file);
                    $this->redirect()->toRoute('livraria-admin');
                } else {
                    $invalidView = new ViewModel();
                    $invalidView->setTemplate('livraria-admin/categorias/invalid.phtml');
                    return $invalidView;
                }
            }
        }
    }
    
    public function editAction(){
        var_dump($this->params('id'));
    }
    
    public function deleteAction(){
        
        $categoriaTable = $this->getCatService();
        $this->setPostForm($this->getForm());
        $id = $this->params('id');
        
        $categoriaTable->deleteData($id);
        $this->redirect()->toRoute('livraria-admin');
    }

    

    public function setPostForm($postForm){
        $this->postForm = $postForm;
    }
    
    public function getForm(){
        return $this->getServiceLocator()->get('LivrariaAdmin\Factory\PostForm');
    }
    
    public function getCatService(){
        return $this->getServiceLocator()->get('Livraria\Service\CategoriaService');
    }
}
