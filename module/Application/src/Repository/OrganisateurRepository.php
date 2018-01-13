<?php
declare(strict_types=1);
namespace Application\Repository;
use Application\Entity\Organisateur;

final class OrganisateurRepository extends \Doctrine\ORM\EntityRepository{

    public function add($organisateur) : void
    {
        $this->getEntityManager()->persist($organisateur);
        $this->getEntityManager()->flush($organisateur);
    }


    public function remove($organisateur) : void
    {
        $this->getEntityManager()->remove($organisateur);
        $this->getEntityManager()->flush();
    }

    public function getOrganisateurs()
    {
        
        return $this->findAll();
    }


}