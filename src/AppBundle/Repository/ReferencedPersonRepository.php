<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ReferencedPersonRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|ReferencedPerson[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("CONCAT_WS(' ', e.lastName, e.firstName) LIKE :q");
        $qb->orderBy('e.lastName');
        $qb->orderBy('e.firstName');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     * @return Collection|ReferencedPerson[]
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect("MATCH (e.firstName, e.lastName) AGAINST(:q BOOLEAN) as HIDDEN score");
        $qb->addSelect("MATCH (e.firstName, e.lastName) AGAINST(:q BOOLEAN) > 0.5");
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);
        return $qb->getQuery();
    }

}
