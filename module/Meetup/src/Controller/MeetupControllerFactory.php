<?php

declare(strict_types=1);
namespace Meetup\Controller;
use Application\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Meetup\Form\MeetupForm;
use Meetup\Filter\CustomInputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;




final class MeetupControllerFactory
{
    public function __invoke(ContainerInterface $container) : MeetupController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
       
        $inputFilter = $container->get(CustomInputFilter::class);
        $em = $container->get(EntityManager::class);
        $hydrator = new DoctrineHydrator($em);
        $meetupForm = new MeetupForm($em);

        return new MeetupController($meetupRepository,$meetupForm,$inputFilter,$hydrator);
    }
}