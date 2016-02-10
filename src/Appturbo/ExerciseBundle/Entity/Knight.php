<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Appturbo\ExerciseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Appturbo\ExerciseBundle\Model\Human;
use Appturbo\ExerciseBundle\Model\FightInterface;
/**
 * Description of Knight
 *
 * @author WADDIZ
 */
/**
 * Appturbo\ExerciseBundle\Entity\Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Appturbo\ExerciseBundle\Entity\KnightRepository")
 */
class Knight extends Human implements FightInterface{
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Integer
     *
     * @ORM\Column(name="strength", type="integer")
     */
    private $strength;
    /**
     * @var Integer
     *
     * @ORM\Column(name="weaponpower", type="integer")
     */
    private $weaponPower;
    
    function __construct($id,$name, $strength, $weaponPower) {
        $this->id = $id;
        $this->name=$name;
        $this->strength = $strength;
        $this->weaponPower = $weaponPower;
    }

    public function getId(){
        return $this->id;
    }

    public function calculatePowerLevel(){
        return $this->strength+$this->weaponPower;
    }
    /**
     * Get Strength
     *
     * @return integer
     */
    public function getStrength() {
        return $this->strength;
    }
    /**
     * Set strength
     *
     * @param integer $strength
     */
    public function setStrength(Integer $strength) {
        $this->strength = $strength;
    }
    
    public function setWeaponPower(Integer $weaponPower) {
        $this->weaponPower = $weaponPower;
    }


    

}
