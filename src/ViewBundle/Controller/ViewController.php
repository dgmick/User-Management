<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 11/08/2017
 * Time: 17:53
 */

namespace ViewBundle\Controller;


use ViewBundle\Entity\ChatDivers;
use ViewBundle\Form\ChatDiversType;
use ViewBundle\Repository\ChatDiversRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends Controller
{

    
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('@View/views/homePage/base.html.twig');
    }

    


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/ChatDivers", name="chatdivers")
     */
    public function chatAction(Request $request){
        
        $chat = new ChatDivers();
        $form = $this->createForm(ChatDiversType::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($chat);
            $em->flush();

            //  return $this->redirectToRoute('chatMusic');
        }

        //Acces au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entitee
        $chatRepository = $em->getRepository('ViewBundle:ChatDivers');

        //Recuperartion de l'ensemble des données liees à l'entitée.
        $chatList = $chatRepository->findAll();

        return $this->render('@View/views/chat/Chat.html.twig',array(
            'chat' => $form->createView(),
            'chatList' => $chatList
        ));
    }


    


}