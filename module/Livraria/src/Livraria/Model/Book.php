<?php


namespace Livraria\Model;


class Book {

    public $id;
    public $name;
    public $abbrev;
    public $testament;
    
    public function exchangeArray(Array $data){
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->abbrev = (isset($data['abbrev'])) ? $data['abbrev'] : null;
        $this->testament = (isset($data['testament'])) ? $data['testament'] : null;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAbbrev() {
        return $this->abbrev;
    }

    function getTestament() {
        return $this->testament;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAbbrev($abbrev) {
        $this->abbrev = $abbrev;
    }

    function setTestament($testament) {
        $this->testament = $testament;
    }


    
}
