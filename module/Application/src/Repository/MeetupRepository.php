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

    public function createMeetupFromTitleDescriptionAndDates(string $title,string $description, DateTime $date_start, DateTime $date_end, string $idOrganisateur=null)
    {
        $meetup = new Meetup($title,$description, $date_start, $date_end);
        
        $organisateur = $this->getEntityManager()->getRepository('Application\Entity\Organisateur')->find($idOrganisateur);

        $meetup->setOrganisateur($organisateur);
        
        return $meetup;
    }

}