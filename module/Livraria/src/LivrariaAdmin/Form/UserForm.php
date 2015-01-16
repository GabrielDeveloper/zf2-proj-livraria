<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form,
    Zend\Form\Element\Text,
    Zend\Form\Element\Password,
    Zend\Form\Element\Hidden,
    Zend\Form\Element\Submit,
    Zend\Form\Element\Email;

class UserForm extends Form{

    public function __construct() {
        parent::__construct('user');
        $this->setAttribute('method', 'POST');
    }
    
    public function setInput(){
        
        $id = new Hidden('id');
        
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setAttribute('class', 'form-control');
        
        $email = new Email('email');
        $email->setLabel('Email');
        $email->setAttribute('class', 'form-control');
        
        $pass = new Password('password');
        $pass->setLabel('Password');
        $pass->setAttribute('class', 'form-control');
        
        $submit = new Submit('submit');
        $submit->setAttributes([
            'value'=>'Cadastrar',
            'class'=>'btn btn-success'
            ]);
        
        $this->add($id)->add($name)->add($email)->add($pass)->add($submit);
        
    }
    
    
}
