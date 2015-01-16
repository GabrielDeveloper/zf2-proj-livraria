<?php

namespace LivrariaAdmin\Service;


use Zend\Authentication\AuthenticationService,
 Zend\Authentication\Adapter\DbTable,
 Zend\Authentication\Storage\Session as AuthSession;

class Auth{
    
    private $adapter;
    private $userService;
    private $sessionUser;
    
    public function __construct($sm) {
        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        $this->userService = $sm->get('Livraria\Model\UserService');
        $this->sessionUser = $sm->get('SessionUser');
        
    }
    
    public function authenticate($params){
        if(!isset($params['email']) || !isset($params['password'])){
            throw new Exception('Não foram passados email ou senha');
        }
        
        $login = $params['email'];
        $senha = $this->userService->setPassword($params['password']);
        
        $auth = new AuthenticationService();
        $adapter = new DbTable($this->adapter);
        $adapter->setTableName('user')
                ->setIdentityColumn('email')
                ->setCredentialColumn('password')
                ->setIdentity($login)
                ->setCredential($senha);
        $auth->setAdapter($adapter);
        $result = $auth->authenticate();
        
        $error = false;
        if(!$result->isValid()){
            $error = true;
        }
        
        $resultRow = $adapter->getResultRowObject();
        
        $storage = new AuthSession('LivrariaAdmin');
        $auth->setStorage($storage);
        $storage->write($resultRow);        
        
        return $error;
    }
    
}
