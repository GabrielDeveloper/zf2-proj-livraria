<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form,
    Zend\Form\Element\Text,
    Zend\Form\Element\Textarea,
    Zend\Form\Element\File,
    Zend\Form\Element\Submit,
    Zend\Form\Element\Hidden;

class PostForm extends Form{
    #use CategoryTrait;
    
    public function __construct(){
        parent::__construct('categorias');
        
        $this->setAttribute('method', 'POST');
        
        $id = new Hidden('cat_id');
        
        $title = new Text('cat_title');
        $title->setLabel('Title');
        $title->setAttributes([
                  'size'=>37,
                  'maxLength'=>128,
                  'class'=>'form-control'
              ]);
        
        $description = new Textarea('cat_description');
        $description->setLabel('Description')
                    ->setAttributes([
                        'rows'=>3,
                        'cols'=>36,
                        'class'=>'form-control'
                    ]);
        
        $image = new File('cat_img');
        $image->setLabel('Image')
              ->setAttributes([
                  'class'=>'form-control'
              ]);
        
        $submit = new Submit('submit');
        $submit->setAttributes([
            'value'=>'Enviar',
            'class'=>'btn btn-success'
            ]);
        
        $this->add($id)
             ->add($title)
             ->add($description)
             ->add($image)
             ->add($submit);
    }
    
}
