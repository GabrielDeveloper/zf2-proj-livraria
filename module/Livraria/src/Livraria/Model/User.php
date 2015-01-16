<?php


namespace Livraria\Model;

class User {
    
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    
    public function exchangeArray($data){
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $hashSenha;
    }

    public function toArray(){
        return [
            'id'=>  $this->getId(),
            'name'=>$this->getName(),
            'email'=>$this->getEmail(),
            'password'=>$this->getPassword()
        ];
    }

    
}
