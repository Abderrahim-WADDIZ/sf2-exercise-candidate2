<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Appturbo\ExerciseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Appturbo\ExerciseBundle\Entity\Knight;
use Appturbo\ExerciseBundle\Form\knightType;
/**
 * Description of knight
 *
 * @author WADDIZ
 */
class knightController extends Controller{
    
    public function getKnightAction(Request $request) {
       $id=$request->attributes->get('id');
       $serializer = $this->container->get('serializer');
       $em = $this->getDoctrine()->getManager();
       $knight=$em->getRepository('Appturbo\ExerciseBundle\Entity\Knight')->get($id);
       if(null==$knight){
           throw new NotFoundHttpException("Knight #".$id." not found.");
       }
       $jsonknight = $serializer->serialize($knight, 'json');
       return new Response($jsonknight);
    }
    
    public function getKnightsAction(Request $request) {
        $serializer = $this->container->get('serializer');
        $limit=$request->query->get('limit')==null ? 25 : $request->query->get('limit');
        $offset=$request->query->get('offset')==null ? 0 : $request->query->get('offset');
        $em = $this->getDoctrine()->getManager();
        $knights=$em->getRepository('Appturbo\ExerciseBundle\Entity\Knight')->all($limit, $offset);
        return new Response($serializer->serialize($knights, 'json'));
    }
    
    public function postKnightAction(Request $request) {
        $serializer = $this->container->get('serializer');
        $em = $this->getDoctrine()->getManager();
        //Form Type doesn't work arguments passed as get while post request 
//        $knight=new Knight();
//        $form = $this->createFormBuilder(new knightType(),$knight);
//        $form->handleRequest($request);
        if($request->getMethod()=='POST'){
            $name = $request->get('name');
            $strength = $request->get('strength');
            $weaponpower = $request->get('weapon_power');
            if($name==null || $strength==null || $weaponpower==null){
                return new Response($serializer->serialize(array('code'=>400,'message'=>"Invaid arguments",), 'json'),400); 
            }
            $knight=new Knight(null,$name,$strength,$weaponpower);
            $em->getRepository('Appturbo\ExerciseBundle\Entity\Knight')->post($knight);
        }
        return new Response($serializer->serialize($knight, 'json'),201);
    }

}
