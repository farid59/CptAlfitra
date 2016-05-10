<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Alfitra\CptBundle\Entity\Donateurs;
use Alfitra\CptBundle\Form\DonateursType;
use Symfony\Component\HttpFoundation\Request;


class ChallengeController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        $collecteurs = $em->getRepository('AlfitraCptBundle:Collecteur')->findAll();

        $forms = array();

        for ($i=0; $i < count($collecteurs); $i++) { 
	        $donateur = new Donateurs();
	        $form = $this->createForm('Alfitra\CptBundle\Form\DonateursType', $donateur, array(
	        	'action' => $this->generateUrl('increment',array('id_evnmt'=>1))
	        	));
            // $form->setAction($this->generateUrl('increment',array('id_evnmt'=>1)));

        	$forms[$i] = $form->createView();
        }
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($evenement);
        //     $em->flush();

        //     return $this->redirectToRoute('challenge', array('id' => 1));
        // }

        return $this->render('AlfitraCptBundle:challenge:challenge.html.twig', array(
        	'idEvenement' => 1,
        	'collecteurs' => $collecteurs,
        	'forms' => $forms
        	));
    }
}
