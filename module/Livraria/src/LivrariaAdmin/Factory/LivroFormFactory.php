<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LivrariaAdmin\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    LivrariaAdmin\Form\LivroForm;

class LivroFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $categorias = $serviceLocator->get('Livraria\Service\CategoriaService');
        
        $form = new LivroForm(); 
        $form->setCategorias($categorias);
        $form->setInputs();
        return $form;
    }
    
}
