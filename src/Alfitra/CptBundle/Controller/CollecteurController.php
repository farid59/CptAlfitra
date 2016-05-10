<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Alfitra\CptBundle\Entity\Collecteur;
use Alfitra\CptBundle\Form\CollecteurType;

/**
 * Collecteur controller.
 *
 * @Route("/collecteur")
 */
class CollecteurController extends Controller
{
    /**
     * Lists all Collecteur entities.
     *
     * @Route("/", name="collecteur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $collecteurs = $em->getRepository('AlfitraCptBundle:Collecteur')->findAll();

        return $this->render('collecteur/index.html.twig', array(
            'collecteurs' => $collecteurs,
        ));
    }

    /**
     * Creates a new Collecteur entity.
     *
     * @Route("/new", name="collecteur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $collecteur = new Collecteur();
        $form = $this->createForm('Alfitra\CptBundle\Form\CollecteurType', $collecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $collecteur->setImage(null); //TODO
            $em->persist($collecteur);
            $em->flush();

            return $this->redirectToRoute('collecteur_show', array('id' => $collecteur->getId()));
        }

        return $this->render('collecteur/new.html.twig', array(
            'collecteur' => $collecteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Collecteur entity.
     *
     * @Route("/{id}", name="collecteur_show")
     * @Method("GET")
     */
    public function showAction(Collecteur $collecteur)
    {
        $deleteForm = $this->createDeleteForm($collecteur);

        return $this->render('collecteur/show.html.twig', array(
            'collecteur' => $collecteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Collecteur entity.
     *
     * @Route("/{id}/edit", name="collecteur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Collecteur $collecteur)
    {
        $deleteForm = $this->createDeleteForm($collecteur);
        $editForm = $this->createForm('Alfitra\CptBundle\Form\CollecteurType', $collecteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($collecteur);
            $em->flush();

            return $this->redirectToRoute('collecteur_edit', array('id' => $collecteur->getId()));
        }

        return $this->render('collecteur/edit.html.twig', array(
            'collecteur' => $collecteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Collecteur entity.
     *
     * @Route("/{id}", name="collecteur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Collecteur $collecteur)
    {
        $form = $this->createDeleteForm($collecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($collecteur);
            $em->flush();
        }

        return $this->redirectToRoute('collecteur_index');
    }

    /**
     * Creates a form to delete a Collecteur entity.
     *
     * @param Collecteur $collecteur The Collecteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Collecteur $collecteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('collecteur_delete', array('id' => $collecteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
