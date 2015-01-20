<?php



namespace Livraria\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
 Zend\Db\Adapter\Adapter,
 Zend\Db\ResultSet\ResultSet,
 Livraria\Model\User;

class UserTable extends AbstractTableGateway{
    
    protected $table = 'user';
    
    public function __construct($adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new User());
        $this->initialize();
    }
    
}
