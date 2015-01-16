<?php

namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
 Zend\Db\TableGateway\AbstractTableGateway,
 Zend\Db\ResultSet\ResultSet;

class LivroTable extends AbstractTableGateway{
    
    protected $table = 'livros';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Livro());
        $this->initialize();
    }
    
}
