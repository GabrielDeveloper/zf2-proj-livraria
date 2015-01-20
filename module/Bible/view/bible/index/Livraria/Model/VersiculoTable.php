<?php


namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\ResultSet\ResultSet;

class VersiculoTable extends AbstractTableGateway{
    
    public $table = 'versiculos_dia';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Versiculo());
        $this->initialize();
    }
    
}
