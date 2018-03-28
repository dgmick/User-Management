<?php
namespace ViewBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Role\Role;



class ViewController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws AccessDeniedException
     */
    public function indexAction()
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux auteurs.');
        }


        return $this->render('@View/presentation/presentation.html.twig');
    }
}