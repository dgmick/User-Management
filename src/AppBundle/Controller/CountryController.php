<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 08/07/2019
 * Time: 18:39
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use AppBundle\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CountryController extends Controller
{
    /**
     * @Route("/admin/country", name="country")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('AppBundle:Country')->findAll();

        return $this->render('@App/Country/index.html.twig', array(
            'countries' => $countries
        ));
    }

    /**
     * @Route("/admin/country/create", name="createCountry")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $countryProvider = $this->get('country.provider');
        $country = $countryProvider->createCountry();

        $form = $this->get('form.factory')->create(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash('succes', 'Le pays a bien été enregistrer');
            return $this->redirect($this->generateUrl('country'));
        }

        return $this->render('@App/Country/new.html.twig', array(
            'country' => $country,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/country/edit/{id}", name="editCountry")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')->find($id);

        $form = $this->createForm('AppBundle\Form\CountryType', $country);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            $this->addFlash('succes', 'Le pays a bien été modifier');
            return $this->redirect($this->generateUrl('country'));
        }

        return $this->render('@App/Country/edit.html.twig', array(
            'country' => $country,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/country/delete/{id}", name="deleteCountry")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')->find($id);

        $em->remove($country);
        $em->flush();
        $this->addFlash('succes', 'Le pays a bien été supprimer');

        return $this->redirect($this->generateUrl('country'));
    }
}
