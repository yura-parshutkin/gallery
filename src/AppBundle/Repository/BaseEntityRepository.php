<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BaseEntityRepository extends EntityRepository
{
    /**
     * @param object$object
     * @param bool $endFlush
     * @return object
     */
    public function save($object, $endFlush = true)
    {
        $this->_em->persist($object);

        if ($endFlush) {
            $this->_em->flush();
        }

        return $object;
    }

    /**
     * @param $object
     * @param bool $endFlush
     */
    public function remove($object, $endFlush = true)
    {
        $this->_em->remove($object);

        if ($endFlush) {
            $this->_em->flush();
        }
    }
}