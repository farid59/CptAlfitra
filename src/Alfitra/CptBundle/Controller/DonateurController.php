<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alfitra\CptBundle\Entity\Donateurs;



class DonateurController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlfitraCptBundle:challenge:challenge.html.twig', array(
        	'idEvenement' => 1
        	));
    }

    public function incrementAction(Request $request, $id_evnmt)
    {
    	$em = $this->getDoctrine()->getManager();

    	// var_dump($request->isMethod('POST'));
        if(isset($request->request->all()['donateurs'])){

        	$donateur = new Donateurs();
        	$montant = $request->request->all()['donateurs']['montant'];
        	isset($montant) && $montant!="" ? : $montant=5;

        	$donateur->setMontant($montant);        	
        	$idCol = intval($request->request->all()['donateurs']['collecteur']);
	        $collecteur = $em->getRepository('AlfitraCptBundle:Collecteur')->find($idCol);
	        $prenom = $collecteur->getPrenom();
	        $evnmt = $em->getRepository('AlfitraCptBundle:Evenement')->find($id_evnmt);
        	$donateur->setCollecteur($collecteur);
        	$moyen = isset($request->request->all()['donateurs']['Visa'])?
        		'Visa':
        		'Cash';
        	$donateur->setMoyenDePaiement($moyen);
        	$donateur->setEvenement($evnmt);
        	$evnmt->setTotalDonateurs($evnmt->getTotalDonateurs()+1);
        	$evnmt->setTotalDons($evnmt->getTotalDons()+$montant);
        	
        	$moyen == 'Cash' ? $evnmt->setTotalCash($evnmt->getTotalCash()+$montant):
        					   $evnmt->setTotalCb($evnmt->getTotalCb()+$montant);

        	$montant > $evnmt->getDonMax() ? $evnmt->setDonMax($montant): null;
        	$em->persist($donateur);
        	$em->persist($evnmt);

        	$em->flush();
        	$id_don = $donateur->getId();
        	$moyenDePaiement = $donateur->getMoyenDePaiement();
			if ($request->isMethod('POST')) {
			  $request->getSession()->set("don_id",$id_don);	
			  $request->getSession()->getFlashBag()->add('notice', 'Le don d\'un montant de '.$montant.' € en '.$moyenDePaiement.' est bien enregistré. Merci à '.$prenom.' .');
			  return $this->redirectToRoute('challenge');
			}
        }
        return $this->render('AlfitraCptBundle:challenge:challenge.html.twig');
    }

    public function removeAction(Request $request, $id_don){
    	$em = $this->getDoctrine()->getManager();
	    $don = $em->getRepository('AlfitraCptBundle:Donateurs')->find($id_don);
	    $em->remove($don);
	    $em->flush();
	  	$request->getSession()->getFlashBag()->add('warning', 'Le dernier don a été supprimé');
	  	return $this->redirectToRoute('challenge');
    }

}
