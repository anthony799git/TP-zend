<?php

declare(strict_types=1);
namespace Meetup\Form;
use Application\Entity\Meetup;
use Application\Entity\Organisateur;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Text;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Date;
use Zend\Form\Form;
use DoctrineModule\Form\Element\ObjectSelect;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Form\Element\EntitySelect;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;



class MeetupForm extends Form 
{
    
    /**
    * @var EntityManager
    */
    private $entityManager;

    

    public function __construct(EntityManager $entityManager)
    {

        parent::__construct('meetup');
        
        $hydrator = new DoctrineHydrator($entityManager, Meetup::class);
        $this->setHydrator($hydrator);
        
        /* champs titre */
        $this->add([
            'type' => Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Titre',

            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ],
        ]);

        /* champs description */
        $this->add([
            'type' => Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
        ]);

        /* champs date de début */
        $this->add([
            'type' => Date::class,
            'name' => 'date_start',
            'options' => [
                'label' => 'Date Début',
                'format' => 'Y-m-d',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
        ]);

        /* champs date de fin */
        $this->add([
            'type' => Date::class,
            'name' => 'date_end',
            'options' => [
                'label' => 'Date Fin',
                'format' => 'Y-m-d',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ],
        ]);
        
        /* champs select d'organisateur */
        $this->add([
            'type' => EntitySelect::class,
            'required' => false,
            'name' => 'organisateur',
            'options' => [
                'label' => 'Organisateur',
                'object_manager' =>  $entityManager,
                'target_class' => Organisateur::class,     
                'empty_option' => 'Choisir un organisateur',
                'label_generator' => function ($targetEntity) {
                    return $targetEntity->getNom() . ' - ' . $targetEntity->getPrenom();
                },
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        
        /* bouton de submit */
        $this->add([
            'type' => Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-success'
            ],
        ]);
        
       
    }

}