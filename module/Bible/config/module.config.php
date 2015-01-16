<?php

return [
    
    'router' => [
        'routes'=>[
            'bible-home'=>[
                'type'=>'Literal',
                'options'=> [
                    'route'=>'/bible',
                    'defaults'=>[
                        'controller'=>'Bible\Controller\Index',
                        'action'=>'index'
                    ]
                ]
            ]
        ]
    ],
    
    'controllers'=>[
        'invokables'=>[
            'Bible\Controller\Index'=>'Bible\Controller\IndexController',
        ]      
    ],
    
    'view_manager'=> [
        'template_path_stack'=>[
            __DIR__.'/../view',
        ]
    ]
    
];



