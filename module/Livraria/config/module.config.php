<?php

return [
    'controllers'=>[
        'invokables'=>[
            'Livraria\Controller\Index'=>'Livraria\Controller\IndexController',
            'LivrariaAdmin\Controller\User'=>'LivrariaAdmin\Controller\UsersController',
            'LivrariaAdmin\Controller\Categorias'=>'LivrariaAdmin\Controller\CategoriasController',
            'LivrariaAdmin\Controller\Livros'=>'LivrariaAdmin\Controller\LivrosController',
            'LivrariaAdmin\Controller\Versiculos'=>'LivrariaAdmin\Controller\VersiculosController',
            'LivrariaAdmin\Controller\Auth'=>'LivrariaAdmin\Controller\AuthController',
        ],
        'aliases'=>[
            'categorias'=>'LivrariaAdmin\Controller\Categorias',
            'user'=>'LivrariaAdmin\Controller\User',
            'index'=>'Livraria\Controller\Index',
            'livros'=>'LivrariaAdmin\Controller\Livros',
            'versiculos'=>'LivrariaAdmin\Controller\Versiculos',
        ]
    ],
   'router'=>[
       'routes'=>[
           'livraria'=>[
               'type'=>'Segment',
               'options'=>[
                   'route'=>'/livraria[/:controller[/:action[/:livro]]]',
                   'defaults'=>[
                       'controller'=>'Livraria\Controller\Index',
                       'action'=>'index',
                   ]
               ]
           ],
           'home'=>[
               'type'=>'Segment',
               'options'=>[
                   'route'=>'/',
                   'defaults'=>[
                       'controller'=>'Livraria\Controller\Index',
                       'action'=>'index',
                   ]
               ]
           ],
           'livraria-admin'=>[
               'type'=>'Segment',
               'options'=>[
                   'route'=>'/admin[/:controller[/:action[/:id[/:cat_id]]]]',
                   'defaults'=>[
                       'controller'=>'categorias',
                       'action'=>'index',
                   ],
               ]
           ],
           'admin-login'=>[
               'type'=>'Literal',
               'options'=>[
                   'route'=>'/admin/login',
                   'defaults'=>[
                       'controller'=>'LivrariaAdmin\Controller\Auth',
                       'action'=>'index'
                   ]
               ]
           ],
           'admin-logout'=>[
               'type'=>'Literal',
               'options'=>[
                   'route'=>'/admin/logout',
                   'defaults'=>[
                       'controller'=>'LivrariaAdmin\Controller\Auth',
                       'action'=>'logout'
                   ]
               ]
           ]
       ]
   ],
    'service_manager'=>[
        'factories'=>[
            'LivrariaAdmin\Factory\PostForm'=>'LivrariaAdmin\Factory\PostFormFactory',
            'LivrariaAdmin\Factory\LivroForm'=>'LivrariaAdmin\Factory\LivroFormFactory',
            'LivrariaAdmin\Factory\PostFilter'=>'LivrariaAdmin\Factory\PostFilterFactory',
            'LivrariaAdmin\Factory\VersiculoDia'=>'LivrariaAdmin\Factory\VersiculoDiaFactory',
            'LivrariaAdmin\Factory\UserForm'=>'LivrariaAdmin\Factory\UserFormFactory',
            'SessionUser' => function ($sm) {
		return new Zend\Session\Container('auth');
            },
        ],
    ],
    'view_manager'=> [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack'=>[
            __DIR__.'/../view',
        ]
    ],
    
];

