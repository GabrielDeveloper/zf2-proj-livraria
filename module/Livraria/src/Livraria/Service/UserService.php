<?php


namespace Livraria\Model;

class UserService {
    
    protected $userTable;
    
    public function __construct(UserTable $userTable) {
        $this->userTable = $userTable;
    }
    
    public function fetchAll(){
        $user = $this->userTable->select();
        return $user;
    }
    
    public function insertData(Array $data){
        $data['password'] = $this->setPassword($data['password']);
        $this->userTable->insert($data);
    }
    
    public function setPassword($password){
        $hashSenha = hash('sha512', $password);
        for($i=0;$i<5;$i++)
            $hashSenha = hash('sha512', $hashSenha);
        return $hashSenha;
    }
    
}
