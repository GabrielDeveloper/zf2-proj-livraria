<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LivrariaAdmin\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    LivrariaAdmin\Form\UserForm;

class UserFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $form = new UserForm(); 
        $form->setInput();
        return $form;
    }
    
}
