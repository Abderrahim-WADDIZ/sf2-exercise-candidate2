<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Appturbo\ExerciseBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Appturbo\ExerciseBundle\Handler\HandlerInterface ;

/**
 * Description of KnightRepository
 *
 * @author WADDIZ
 */
class KnightRepository extends EntityRepository implements HandlerInterface {

    public function all($limit, $offset) {
        $query=$this->getEntityManager()
                    ->createQuery("SELECT k FROM Appturbo\ExerciseBundle\Entity\Knight k")
                    ->setMaxResults($limit)
                    ->setFirstResult($offset);
        return $query->getResult();
    }

    public function get($id) {
         return $this->findOneById($id);
    }

    public function post($resource) {
        $this->getEntityManager()
             ->persist($resource);
        $this->getEntityManager()->flush();
    }

}
