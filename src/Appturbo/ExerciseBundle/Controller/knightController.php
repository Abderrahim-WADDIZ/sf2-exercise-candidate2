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
use Appturbo\ExerciseBundle\Handler\HandlerInterface ;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Appturbo\ExerciseBundle\Entity\Knight;
/**
 * Description of knight
 *
 * @author WADDIZ
 */
class knightController extends Controller implements HandlerInterface {
    
    public function getKnightAction(Request $request) {
       $id=$request->attributes->get('id');
       $serializer = $this->container->get('serializer');
       $knight=$this->get($id);
       if(null==$this->get($id)){
           throw new NotFoundHttpException("Knight #".$id." not found.");
       }
       $jsonknight = $serializer->serialize($knight, 'json');
       return new Response($jsonknight);
    }
    
    public function getKnightsAction(Request $request) {
        $serializer = $this->container->get('serializer');
        $limit=$request->query->get('limit')==null ? 25 : $request->query->get('limit');
        $offset=$request->query->get('offset')==null ? 0 : $request->query->get('offset');
        $knights=$this->all($limit, $offset);
        return new Response($serializer->serialize($knights, 'json'));
    }
    
    public function postKnightAction(Request $request) {
        $serializer = $this->container->get('serializer');
        if($request->getMethod()=='POST'){
            $name = $request->request->get('name');
            $strength = $request->request->get('strength');
            $weaponpower = $request->request->get('weapon_power');
            if($name==null || $strength==null || $weaponpower==null){
                $array=array();
                $array['message']="Invaide arguments";
                $array['code']=400;
                return new Response($serializer->serialize($array, 'json'),400); 
            }
            $knight=new Knight(null,$name,$strength,$weaponpower);
            $this->post($knight);
        }
        return new Response($serializer->serialize($knight, 'json'),201);
    }

    public function all($limit, $offset) {
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery("SELECT k FROM Appturbo\ExerciseBundle\Entity\Knight k")
                  ->setMaxResults($limit)
                  ->setFirstResult($offset);
        return $query->getResult();
    }

    public function get($id) {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('Appturbo\ExerciseBundle\Entity\Knight')->findBy(array('id' =>$id));
    }

    public function post($resource) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($resource);
         $em->flush();
    }

}
