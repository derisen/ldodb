<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class KeywordRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|Keyword[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.keyword LIKE :q");
        $qb->orderBy('e.keyword');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     * @return Collection|Keyword[]
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect("MATCH (e.keyword) AGAINST(:q BOOLEAN) as HIDDEN score");
        $qb->addSelect("MATCH (e.keyword) AGAINST(:q BOOLEAN) > 0.5");
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);
        return $qb->getQuery();
    }

}
