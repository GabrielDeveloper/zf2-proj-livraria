<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form,
    Zend\Form\Element\Text,
    Zend\Form\Element\Textarea,
    Zend\Form\Element\File,
    Zend\Form\Element\Submit,
    Zend\Form\Element\Select,
    Zend\Form\Element\Hidden;
use LivrariaAdmin\CategoriaTrait;

class LivroForm extends Form{
    use CategoriaTrait;
    
    public function __construct(){
        parent::__construct('livros');
        
        $this->setAttribute('method', 'POST');
        $this->setAttribute('enctype', 'multipart/form-data');
        
    }
    
    public function setInputs(){
        
        $id = new Hidden('liv_id');
        
        $title = new Text('liv_title');
        $title->setLabel('Title');
        $title->setAttributes([
                  'size'=>37,
                  'maxLength'=>128,
                  'class'=>'form-control'
              ]);
        
        $description = new Textarea('liv_description');
        $description->setLabel('Description')
                    ->setAttributes([
                        'rows'=>3,
                        'cols'=>36,
                        'class'=>'form-control'
                    ]);
        
        $author = new Text('liv_author');
        $author->setLabel('Author')
               ->setAttributes([
                   'size'=>37,
                  'maxLength'=>128,
                  'class'=>'form-control'
               ]);
        
        $image = new File('liv_img');
        $image->setLabel('Image')
              ->setAttributes([
                  'class'=>'form-control'
              ]);
        
        $submit = new Submit('submit');
        $submit->setAttributes([
            'value'=>'Enviar',
            'class'=>'btn btn-success'
            ]);
        
        $categoria = new Select('liv_cat_id');
        $categoria->setLabel('Categoria')
                  ->setAttributes([
                          'class'=>'form-control'
                      ]);
        $categoria->setValueOptions(array_combine(
                $this->getCategoriaId(),
                $this->getCategoriaName()
        ));
        
        $this->add($id)
             ->add($title)
             ->add($description)
             ->add($author)
             ->add($image)
             ->add($submit)
             ->add($categoria);
    }
    
}
