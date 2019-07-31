<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws AccessDeniedException
     */
    public function indexAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Accès limité aux utilisateurs.');
        }

        return $this->render('@App/presentation/presentation.html.twig');

        /** picture profile */

//        $user = $this->getUser();
//
//        $editProfilePicture = $this->createForm('UserBundle\Form\ProfilePictureType', $user);
//        $editProfilePicture->handleRequest($request);
//
//        $uploadFiles = $this->get('upload.files');
//
//        if ($editProfilePicture->isSubmitted() && $editProfilePicture->isValid()) {
//            $file = $editProfilePicture->get('imagesId')->getData();
//            $fileName = $uploadFiles->upload($file);
//
//            $user->setImagesId($fileName);
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//        }
//        return $this->render('@App/presentation/presentation.html.twig', array(
//            'user' => $user,
//            'form' => $editProfilePicture->createView()
//        ));

        /** Mail */
//        $user = $this->getUser();
//        return $this->render('@App/Mail/Layout/registration_success.html.twig', array(
//            'user' => $user));
    }
}
