<?php
namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Membre;
use UserBundle\Form\MembreType;
use UserBundle\Form\UserType;
use ViewBundle\Entity\ChatDivers;
use ViewBundle\Form\ChatDiversType;
use UserBundle\Entity\User;
use UserBundle\Entity\Friend;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class UserController extends Controller
{
    /**
     * @Route("/partenaires" , name="partenaires")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function abonneAction(){
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $userRepository = $em->getRepository('UserBundle:User');
        $abooneesList = $userRepository->findAllUsers();

        return $this->render('@User/Partenaires/partenairesView.html.twig', array (
            'abonnesList' => $abooneesList
        ));
    }

    /**
     * @Route("/partenaires/mes-partenaires/{id}", name="mesPartenaires")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mesPartenairesAction(User $user)
    {
        $partenaire = $this->get('security.token_storage')->getToken()->getUser();
        $em =$this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($user);
        $user_db = $em->getRepository('UserBundle:User')->find($partenaire->getId());


        return $this->render('@User/Partenaires/mesPartenaires.html.twig', array(
            'users'=> $user,
            'users' => $user_db->getUsers(),

        ));
    }

    /**
     * @Route("/{id}/ajout", name="ajout")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(User $user)
    {
        $user_current = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $user_add = $em->getRepository('UserBundle:User')->find($user->getId());
        $user_db = $em->getRepository('UserBundle:User')->find($user_current->getId());
        $user_db->addUser($user_add);
        $em->persist($user_db);
        $em->flush();
        return $this->redirectToRoute('partenaires');
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUserAction(User $user)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $userRepository = $em->getRepository('UserBundle:User');
        $userDelete = $userRepository->findOneById($user);
        $em->remove($userDelete);
        $em->flush();
        return $this->redirectToRoute('partenaires',array('user'=> $user->getId()));
    }
    
    /**
     * @Route("/mon-espace/{id}/edit", name="edit")
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm(UserType::class, $user);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if (null !==  $editForm['attachment']->getData()) {
                $file = $editForm['attachment']->getData();
                if (null !== $user->getIllustration()) {
                    $oldFile = $this->getParameter('attachment_directory') . '/' . $user->getIllustration();
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                /** encodage du nom du fichier uploadé */
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                /** Ré-ecriture avec le prénom et nom du user */
                $filename = $user->getFirstName().'-'.$user->getLastName().'_Profil-Picture.'.explode('.',$filename)[1];
                $user->setIllustration($filename);
                $file->move(
                    $this->getParameter('attachment_directory'),
                    $filename);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Validation de votre modification');

                return $this->redirectToRoute('fos_user_profile_show',array('user'=> $user->getId()));
            }
        }

        return $this->render('@User/profil/edit.html.twig' , array(
            'editForm' => $editForm->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/messagerie", name="messagerie")
     */
    public function chatAction(Request $request)
    {
        $chat = new ChatDivers();
        $form = $this->createForm(ChatDiversType::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chat);
            $em->flush();
        }
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();

        $chatRepository = $em->getRepository('ViewBundle:ChatDivers');
        $chatList = $chatRepository->findAll();

        return $this->render('UserBundle:chat:Chat.html.twig',array(
            'chat' => $form->createView(),
            'chatList' => $chatList
        ));
    }


}