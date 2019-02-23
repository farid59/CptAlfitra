<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Alfitra\CptBundle\Entity\Formulaire;
use Alfitra\CptBundle\Form\FormulaireType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Formulaire controller.
 *
 * @Route("/ecran")
 */
class EcranController extends Controller
{
    /**
     * Lists all statistics
     *
     * @Route("/", name="ecran_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $montantTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalMontant();
        if ($montantTotal == null) { 
            $montantTotal = 0;
        }
        return $this->render('AlfitraCptBundle:ecran:index.html.twig', array(
            'don' => $montantTotal,
        ));
    }

    /**
     * Get total montant
     *
     * @Route("/total", name="ecran_total")
     * @Method("GET")
     */
    public function getTotalMontant()
    {
        $em = $this->getDoctrine()->getManager();
        $montantTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalMontant();
        $mensuelTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalMensuel();
        $cashTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalCash();
        $promesseTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalPromesse();
        return new JsonResponse(array('don' => $montantTotal, 
                                    'mensuel' => $mensuelTotal, 
                                    'cash' => $cashTotal,
                                    'promesse' => $promesseTotal));
        // return new Response(array($montantTotal, $mensuelTotal));
    }
    /**
     * Get total mensuel
     *
     * @Route("/mensuel", name="ecran_mensuel")
     * @Method("GET")
     */
    public function getTotalMensuel()
    {
        $em = $this->getDoctrine()->getManager();
        $montantTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalMensuel();
        return new Response($montantTotal);
    }
    /**
     * Get total cash
     *
     * @Route("/cash", name="ecran_cash")
     * @Method("GET")
     */
    public function getTotalCash()
    {
        $em = $this->getDoctrine()->getManager();
        $montantTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalCash();
        return new Response($montantTotal);
    }
    /**
     * Get total promesse
     *
     * @Route("/promesse", name="ecran_promesse")
     * @Method("GET")
     */
    public function getTotalPromesse()
    {
        $em = $this->getDoctrine()->getManager();
        $montantTotal = $em->getRepository('AlfitraCptBundle:Formulaire')->getTotalPromesse();
        return new Response($montantTotal);
    }
}