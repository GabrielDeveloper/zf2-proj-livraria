<?php

namespace Bible\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    
    public function indexAction() {
        
        $planosService = $this->getServiceLocator()->get("Bible\Model\PlanosService");
        //$planosService->insert(['nome'=>'Testando Insert']);
        $planos = $planosService->fetchAll();
        
        return new ViewModel(['planos'=>$planos]);
    }
}
