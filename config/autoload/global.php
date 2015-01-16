<?php

return array(
    'db'=>[
        'driver'=>'Pdo',
        'dsn'=>'mysql:dbname=zend_proj2;host=localhost',
        'driver_options' =>[
            PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
        ]
    ],
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    )
);
