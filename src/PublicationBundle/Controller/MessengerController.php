<?php
namespace PublicationBundle\Controller;

use PublicationBundle\Entity\Messenger;
use PublicationBundle\Form\MessengerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MessengerController extends Controller
{
    /**
     * @Route("/messenger", name="messenger")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function chatAction(Request $request)
    {
        $messenger = new Messenger();
        $form = $this->createForm(MessengerType::class, $messenger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($messenger);
            $em->flush();
        }
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();

        $messengerRepository = $em->getRepository('PublicationBundle:Messenger');
        $messengerList = $messengerRepository->findAll();

        return $this->render('PublicationBundle:chat:Chat.html.twig',array(
            'chat' => $form->createView(),
            'messengerList' => $messengerList
        ));
    }
    
}