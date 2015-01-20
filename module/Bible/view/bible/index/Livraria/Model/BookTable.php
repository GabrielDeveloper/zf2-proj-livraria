<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Model;

use Zend\Db\Adapter\Adapter,
 Zend\Db\TableGateway\AbstractTableGateway,
 Zend\Db\ResultSet\ResultSet;

class BookTable extends AbstractTableGateway{
    
    protected $table = 'books';

    public function __construct($adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Book());
        $this->initialize();
    }
}
