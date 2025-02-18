<?php

namespace Comentario;

use Comentario\Model\ComentarioTableFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\ComentarioController::class => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'comentario' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/comentario[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ComentarioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'comentario' => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            Model\ComentarioTable::class => ComentarioTableFactory::class,
        ],

    ],
];
