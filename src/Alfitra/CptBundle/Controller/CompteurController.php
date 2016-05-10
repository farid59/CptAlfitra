<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CompteurController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $totaDons = $em->getRepository('AlfitraCptBundle:Donateurs')->getTotalDefis(1);
        $totalDefis = $totaDons / 5;
        return $this->render('AlfitraCptBundle:compteur:compteur.html.twig', array(
        	'nb' => $totalDefis
        	));
    }

    public function getNbAction()
    {
		$em = $this->getDoctrine()->getManager();
        $totaDons = $em->getRepository('AlfitraCptBundle:Donateurs')->getTotalDefis(1);
        $totalDefis = $totaDons / 5;
        return new Response($totalDefis);
    }
}
