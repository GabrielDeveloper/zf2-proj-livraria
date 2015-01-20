<?php

return [
    
    'router' => [
        'routes'=>[
            'bible-home'=>[
                'type'=>'Segment',
                'options'=> [
                    'route'=>'/bible/[:action[/:book[/:page]]]',
                    'defaults'=>[
                        'controller'=>'Bible\Controller\Index',
                        'action'=>'index',
                        'page'=>1,
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



