<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 11/08/2017
 * Time: 17:54
 */

namespace UserBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\Friend;


class UserController extends Controller
{

    // Liste des abonnees

    /**
     * @Route("/abonnees" , name="abonnees")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function abonneAction(){

        //Acces au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entitee
        $userRepository = $em->getRepository('UserBundle:User');
        $friendRepository = $em->getRepository('UserBundle:Friend');

        //Recuperartion de l'ensemble des données liees à l'entitée.
        $abooneesList = $userRepository->findAll();
        $friendList = $friendRepository->findAll();
        
        return $this->render('@User/Abonnes/abonnesView.html.twig', array (
            'abonnes' => $abooneesList,
            'friend' => $friendList,
            
        ));
    }


    /**
     * @Route("/profile" , name="profile")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilAction(){
        
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        
        $userRepository = $em->getRepository('UserBundle:User');
        
        $profilListe = $userRepository->findAll();
        

        return $this->render('@View/views/profil/profil.html.twig',array(
           'profil' => $profilListe, 
        ));
        
        
    }

    
    


    /**
     * @Route("/abonnees/pote" , name="friend")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function friendAction(){


        return $this->render('@User/Abonnes/friend.html.twig');
    }


    /**
     *
     * @Route("/{id}/edit", name="friend_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Friend $friend
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Friend $friend){

        $editForm = $this->createForm('AppBundle\Form\FriendType', $friend);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }


        return $this->render('@User/Abonnes/edit.html.twig', array(
            'friend' => $friend,
            'edit_form' => $editForm->createView(),
        ));
    }
    


}