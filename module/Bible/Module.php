<?php

namespace Bible;

use Bible\Model\PlanosTable;

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
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig(){
        return [
            'factories' => [
                'Bible\Model\PlanosService'=>function($service){
                    $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
                    $planosTable = new PlanosTable($dbAdapter);
                    $planosService = new Model\PlanosService($planosTable);
                    return $planosService;
                }
            ]
        ];
    }
}
