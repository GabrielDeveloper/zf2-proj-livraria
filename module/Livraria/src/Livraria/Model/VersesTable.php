<?php


namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
 Zend\Db\TableGateway\AbstractTableGateway,
 Zend\Db\ResultSet\ResultSet;

class VersesTable extends AbstractTableGateway{
    
    protected $table = 'verses';
    protected $columns;
    protected $quantifier;
    
    public function __construct($adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Verses());
        $this->initialize();
    }
    
    public function setColumns(Array $data){
        $this->columns = $data;
    }
    
    public function setQuantifier($data){
        $this->quantifier = $data;
    }
    
}
