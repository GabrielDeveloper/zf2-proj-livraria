<?php

namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
 Zend\Db\ResultSet\ResultSet,
 Zend\Db\TableGateway\AbstractTableGateway;

class CategoriaTable extends AbstractTableGateway{
    
    protected $table = 'categoria';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Categoria());
        $this->initialize();
    }
    
}
