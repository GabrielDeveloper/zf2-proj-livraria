<?php


namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
 Zend\View\Model\ViewModel,
 Zend\Authentication\Result,
 Zend\Authentication\AuthenticationService,
 Zend\Authentication\Storage\Session;

use LivrariaAdmin\Form\LoginForm;

class AuthController extends AbstractActionController{
    
    public function indexAction() {
        
        $form = new LoginForm();
        $form->setInput();
        
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $authService = $this->getServiceLocator()->get('LivrariaAdmin\Service\Auth');
                $result = $authService->authenticate($form->getData());
                if($result == false)
                    $this->redirect()->toRoute('livraria-admin');
                else
                    $error = 'Erro no email ou senha';
            }
        }
        return new ViewModel(['form'=>$form, 'error'=>$error]);
        
    }
    
    public function logoutAction(){
        $auth = new AuthenticationService();
        if($auth->hasIdentity()){
            $auth->clearIdentity();
        }
            $this->redirect()->toRoute('admin-login');
    }
}
