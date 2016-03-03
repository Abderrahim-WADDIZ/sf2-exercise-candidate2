<?php

namespace Appturbo\ExerciseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Appturbo\ExerciseBundle\Services\Arena;

class ArenaTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testFight2()
    {
        $knight = $this->em->getRepository('AppturboExerciseBundle:Knight')->find(1);
        $knight2 = $this->em->getRepository('AppturboExerciseBundle:Knight')->find(2);

        $result = Arena::fight($knight, $knight2);

        $this->assertEquals(get_class($result), 'Appturbo\ExerciseBundle\Entity\Knight');
        $this->assertEquals('Elrynd', $knight2->getName());
    }
}
