<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository
{

    public function findAllUsers()
    {
        $qb = $this->createQueryBuilder('user');
        $qb->orderBy('user.username', 'ASC');
        return $qb->getQuery()->getResult();
    }

}
