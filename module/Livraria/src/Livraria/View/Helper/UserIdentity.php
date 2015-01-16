<?php

namespace Livraria\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class UserIdentity extends AbstractHelper{
    
    protected $authService;
    
    public function getAuthService(){
        return $this->authService;
    }
    
    public function __invoke() {
        $this->authService = new AuthenticationService();
        if($this->getAuthService()->hasIdentity()){
            $session = new Session('LivrariaAdmin');
            return $session->read();
        } else {
            return false;
        }
    }
    
}
