<?php

namespace UserBundle\Controller;

use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     * @throws \Exception
     */
    public function indexAction()
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw new \Exception('vous ne pouvez pas acceder a cette page ');
        }

        dump('dd');
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();

        $result = $this->get('app.pagination')->paginate($users, 9);

        return $this->render('user/index.html.twig', array(
            'users' => $result,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new \Exception('vous ne pouvez pas acceder a cette page ');
        }

        $uploadFiles = $this->get('upload.files');

        $user = new User();
        $form = $this->createForm('UserBundle\Form\Type\RegistrationFormType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imagesId')->getData();
            $fileName = $uploadFiles->upload($file);

            $user->setImagesId($fileName);
            $user->setEnabled(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @throws \Exception
     */
    public function showAction(User $user)
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw new \Exception('vous ne pouvez pas acceder a cette page ');
        }

        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     * @throws \Exception
     */
    public function editAction(Request $request, User $user)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new \Exception('vous ne pouvez pas acceder a cette page ');
        }

        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('UserBundle\Form\Type\UserUpdateType', $user);
        $editForm->handleRequest($request);

        $uploadFiles = $this->get('upload.files');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $editForm->get('imagesId')->getData();
            $fileName = $uploadFiles->upload($file);

            $user->setImagesId($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     * @throws \Exception
     */
    public function deleteAction(Request $request, User $user)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new \Exception('vous ne pouvez pas acceder a cette page ');
        }

        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @param User $user
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
