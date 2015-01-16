<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
 Zend\View\Model\ViewModel;

class UsersController extends AbstractActionController{
    
    public function indexAction(){
        $userService = $this->getServiceLocator()->get('Livraria\Model\UserService');
        $user = $userService->fetchAll();
        
        return new ViewModel(['data'=>$user]);
    }
    
    public function formAction(){
        $form = $this->getServiceLocator()->get('LivrariaAdmin\Factory\UserForm');
        return new ViewModel(['form'=>$form]);
    }
    
    public function addAction(){
        $userService = $this->getServiceLocator()->get('Livraria\Model\UserService');
        $form = $this->params()->fromPost();
        unset($form['submit']);
        $userService->insertData($form);
    }
    
    
}
