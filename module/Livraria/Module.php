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
                'Livraria\Model\CategoriaService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $categoriaTable = new Model\CategoriaTable($adapter);
                    $categoriaService = new Model\CategoriaService($categoriaTable);
                    return $categoriaService;
                },
                'Livraria\Model\VersiculoService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $versiculoTable = new Model\VersiculoTable($adapter);
                    $versiculoService = new Model\VersiculoService($versiculoTable);
                    return $versiculoService;
                },
                'Livraria\Model\BookService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $bookTable = new Model\BookTable($adapter);
                    $bookService = new Model\BookService($bookTable);
                    return $bookService;
                },
                'Livraria\Model\VersesService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $versesTable = new Model\VersesTable($adapter);
                    $versesService = new Model\VersesService($versesTable);
                    return $versesService;
                },
                'Livraria\Model\LivroService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $livroTable = new Model\LivroTable($adapter);
                    $livroService = new Model\LivroService($livroTable);
                    return $livroService;
                },
                'Livraria\Model\UserService'=>function($sm){
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $userTable = new Model\UserTable($adapter);
                    $userService = new Model\UserService($userTable);
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
