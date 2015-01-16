<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form,
    Zend\Form\Element\Text,
    Zend\Form\Element\Password,
    Zend\Form\Element\Submit;

class LoginForm extends Form{

    public function __construct() {
        parent::__construct('login');
        $this->setAttribute('method', 'POST');
    }
    
    public function setInput(){
        
        $login = new Text('email');
        $login->setLabel('Email');
        $login->setAttribute('class', 'form-control');
        
        $pass = new Password('password');
        $pass->setLabel('Password');
        $pass->setAttribute('class', 'form-control');
        
        $submit = new Submit('submit');
        $submit->setAttributes([
            'value'=>'Login',
            'class'=>'btn btn-success'
            ]);
        
        $this->add($login)->add($pass)->add($submit);
        
    }
    
    
}
