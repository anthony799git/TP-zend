<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Meetup;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Meetup\Form\MeetupForm;
use Meetup\Filter\CustomInputFilter;

return [
    'router' => [
        'routes' => [
            'meetups' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetups',
                    'defaults' => [
                        'controller' => Controller\MeetupController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' =>true,
                'child_routes' => [
                    'new' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'new',
                            ],
                        ],
                    ],
                    'show' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/show/:id',
                            'defaults' => [
                                'action'     => 'show',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                        ],
                    ]
                    ,
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete/:id',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MeetupController::class => Controller\MeetupControllerFactory::class,
            
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
            CustomInputFilter::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'meetup/meetup/index' => __DIR__ . '/../view/meetup/index.phtml',
            'meetup/meetup/new' => __DIR__ . '/../view/meetup/new.phtml',
            'meetup/meetup/show' => __DIR__ . '/../view/meetup/show.phtml',
            'meetup/meetup/edit' => __DIR__ . '/../view/meetup/edit.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
