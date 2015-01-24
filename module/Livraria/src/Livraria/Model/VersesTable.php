<?php


namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
 Zend\Db\TableGateway\AbstractTableGateway,
 Zend\Db\ResultSet\ResultSet;

class VersesTable extends AbstractTableGateway{
    
    protected $table = 'verses';
    
    public function __construct($adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Verses());
        $this->initialize();
    }
    
}
