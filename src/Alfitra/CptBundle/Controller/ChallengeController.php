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
        $dons_repository = $em->getRepository('AlfitraCptBundle:Donateurs');
        $forms = array();

        $indice = 0;
        foreach ($collecteurs as $col ) {
            $donateur = new Donateurs();
            $form = $this->createForm('Alfitra\CptBundle\Form\DonateursType', $donateur, array(
                'action' => $this->generateUrl('increment',array('id_evnmt'=>1))
                ));
            $forms[$indice] = $form->createView();
            $indice++;
        }
        $donsParCollecteur = $dons_repository->getDonsCollectes();
        $superCollecteur = $donsParCollecteur[0][1];
        $faibleCollecteur = $donsParCollecteur[0][1];
        for ($i=0; $i < count($donsParCollecteur); $i++) { 
            if ($donsParCollecteur[$i][1] > $superCollecteur) 
                $superCollecteur = $donsParCollecteur[$i][1];
            if ($donsParCollecteur[$i][1] < $faibleCollecteur) 
                $faibleCollecteur = $donsParCollecteur[$i][1];
        }
        return $this->render('AlfitraCptBundle:challenge:challenge.html.twig', array(
        	'idEvenement' => 1,
        	'collecteurs' => $collecteurs,
        	'forms' => $forms,
            'donsParCollecteur' => $donsParCollecteur,
            'faible' => $faibleCollecteur,
            'super' => $superCollecteur
        	));
    }
}
