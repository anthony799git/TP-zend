<?php
declare(strict_types=1);
namespace Application\Repository;
use DateTime;
use Application\Entity\Meetup;

final class MeetupRepository extends \Doctrine\ORM\EntityRepository{

    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);

        $this->getEntityManager()->flush($meetup);
    }

    public function update($meetup) : void
    {
        $this->getEntityManager()->flush($meetup);
    }

    public function remove($meetup) : void
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }

}