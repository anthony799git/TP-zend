<?php

declare(strict_types=1);
namespace Meetup\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Validator\Callback;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Date;
use Zend\Filter\DateTimeFormatter;


class CustomInputFilter extends InputFilter
{

    public function __construct()
    {

        $factory = new InputFactory();

        $this->add($factory->createInput([
            'name' => 'title',
            'required'   => true,
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 25,
                    ],
                ],
            ],
        ]));
   

        $this->add($factory->createInput([
            'name'       => 'date_start',
            'required'   => true,
            'filters' => [
                [
                    'name' => DateTimeFormatter::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ]
            ],
            'validators' =>  [
                [
                    'name' => Date::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ],
            ],
        ]));
        
        $this->add($factory->createInput([
            'name'       => 'organisateur',
            'required'   => false,
        ]));

        $this->add($factory->createInput([
            'name'       => 'date_end',
            'required'   => true,
            'filters' => [
                [
                    'name' => DateTimeFormatter::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ]
            ],
            'validators' =>  [
                [
                    'name' => Date::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ],
                [
                    'name' => Callback::class,
                    'options' => [
                        'callback' => function ($value, $context = []) {

                            $startDate = $context['date_start'];
                            $endDate = $value;
                            return $startDate <= $endDate;
                        },
                        'messages' => [
                            Callback::INVALID_VALUE => 'date_end must be early than the date_start',
                        ],
                        
                    ],
                ],
            ],
        ]));

    }
}