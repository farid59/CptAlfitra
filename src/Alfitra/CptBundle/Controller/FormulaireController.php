<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Alfitra\CptBundle\Entity\Formulaire;
use Alfitra\CptBundle\Form\FormulaireType;

/**
 * Formulaire controller.
 *
 * 
 */
class FormulaireController extends Controller
{
    /**
     * Lists all Formulaire entities.
     *
     * @Route("/", name="formulaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formulaires = $em->getRepository('AlfitraCptBundle:Formulaire')->findAll();

        return $this->render('AlfitraCptBundle:formulaire:index.html.twig', array(
            'donateurs' => $formulaires,
        ));
    }

    /**
     * Lists all Formulaire entities.
     *
     * @Route("/annonce", name="formulaire_annonce")
     * @Method("GET")
     */
    public function annonceAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formulaires = $em->getRepository('AlfitraCptBundle:Formulaire')
                ->findBy(array('announced' => 0),
                        array('date' => 'asc'));

        return $this->render('AlfitraCptBundle:formulaire:annonce.html.twig', array(
            'donateurs' => $formulaires,
        ));
    }

    /**
     * Creates a new Formulaire entity.
     *
     * @Route("/new", name="formulaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formulaire = new Formulaire();
        $postedBy = $this->getUser()->getUsername();
        
        $form = $this->createForm(FormulaireType::class, $formulaire, array(
            'postedBy' => $postedBy,
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaire);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Le don d\'un montant de '.$formulaire->getMontant().' € est bien enregistré.');
            return $this->redirectToRoute('formulaire_new');
        }

        
        return $this->render('AlfitraCptBundle:formulaire:new.html.twig', array(
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ));
    }

    // /**
    //  * Finds and displays a Formulaire entity.
    //  *
    //  * @Route("/{id}", name="formulaire_show")
    //  * @Method("GET")
    //  */
    // public function showAction(Formulaire $formulaire)
    // {
    //     $deleteForm = $this->createDeleteForm($formulaire);

    //     return $this->render('AlfitraCptBundle:formulaire:show.html.twig', array(
    //         'formulaire' => $formulaire,
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    /**
     * Displays a form to edit an existing Formulaire entity.
     *
     * @Route("/{id}/edit", name="formulaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);
        $editForm = $this->createForm('Alfitra\CptBundle\Form\FormulaireType', $formulaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaire);
            $em->flush();

            return $this->redirectToRoute('formulaire_edit', array('id' => $formulaire->getId()));
        }

        return $this->render('AlfitraCptBundle:formulaire:edit.html.twig', array(
            'formulaire' => $formulaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Formulaire entity.
     *
     * @Route("/{id}", name="formulaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Formulaire $formulaire)
    {
        $form = $this->createDeleteForm($formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formulaire);
            $em->flush();
        }

        return $this->redirectToRoute('formulaire_index');
    }

    /**
     * Deletes a Formulaire entity.
     *
     * @Route("/check/{id}", name="formulaire_confirmeAnnonce")
     * @Method("GET")
     */
    public function confirmeAnnonceAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $formulaire = $em->getRepository('AlfitraCptBundle:Formulaire')
                ->findOneById($id);
        $formulaire->setAnnounced(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($formulaire);
        $em->flush();


        return $this->redirectToRoute('formulaire_annonce');
    }

    /**
     * Creates a form to delete a Formulaire entity.
     *
     * @param Formulaire $formulaire The Formulaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Formulaire $formulaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formulaire_delete', array('id' => $formulaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
