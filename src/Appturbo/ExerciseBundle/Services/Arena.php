<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Appturbo\ExerciseBundle\Services;
use Appturbo\ExerciseBundle\Entity\FighterInterface;
/**
 * Description of Arena
 *
 * @author WADDIZ
 */
class Arena {
    public static function fight($f1,$f2){
        if($f1->calculatePowerLevel()==$f2->calculatePowerLevel()){
            return 0;
        }
        return $f1->calculatePowerLevel()>$f2->calculatePowerLevel() ? $f1 : $f2;
    }
}
