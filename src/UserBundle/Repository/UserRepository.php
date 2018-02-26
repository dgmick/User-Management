<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;


class FriendRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy(
            [
                'username' => 'ASC'
            ]
        );
    }

}
