<?php

namespace Livraria;

use Zend\ModuleManager\ModuleManager,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

use LivrariaAdmin\Service;
use Livraria\View\Helper\UserIdentity;

class Module {
   public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__.'Admin' => __DIR__ . '/src/' . __NAMESPACE__.'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig(){
        return [
            'factories'=>[
                'Livraria\Service\CategoriaService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $categoriaTable = new Model\CategoriaTable($adapter);
                    $categoriaService = new \Livraria\Service\CategoriaService($categoriaTable);
                    return $categoriaService;
                },
                'Livraria\Service\VersiculoService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $versiculoTable = new Model\VersiculoTable($adapter);
                    $versiculoService = new \Livraria\Service\VersiculoService($versiculoTable);
                    return $versiculoService;
                },
                'Livraria\Service\BookService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $bookTable = new Model\BookTable($adapter);
                    $bookService = new \Livraria\Service\BookService($bookTable);
                    return $bookService;
                },
                'Livraria\Service\VersesService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $versesTable = new Model\VersesTable($adapter);
                    $versesService = new \Livraria\Service\VersesService($versesTable);
                    return $versesService;
                },
                'Livraria\Service\LivroService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $livroTable = new Model\LivroTable($adapter);
                    $livroService = new \Livraria\Service\LivroService($livroTable);
                    return $livroService;
                },
                'Livraria\Service\UserService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $userTable = new Model\UserTable($adapter);
                    $userService = new \Livraria\Service\UserService($userTable);
                    return $userService;
                },
                'LivrariaAdmin\Service\Auth'=>  function($sm){
                    $auth = new Service\Auth($sm);
                    return $auth;
                }
            ],
        ];
    }
    
    public function init(ModuleManager $moduleManager){
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach('LivrariaAdmin', 'dispatch', function ($e){
            $auth = new AuthenticationService();
            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
            if(!$auth->hasIdentity() && $matchedRoute=='livraria-admin'){
                return $controller->redirect()->toRoute('admin-login');
            }
        }, 99);
        
    }
    
    public function getViewHelperConfig(){
        return [
            'invokables'=>[
                'UserIdentity'=>new UserIdentity()
            ]
        ];
    }
    
}
