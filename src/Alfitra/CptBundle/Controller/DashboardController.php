<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $evmt = $em->getRepository('AlfitraCptBundle:Evenement')->find(1);
        $nbParticipant = $em->getRepository('AlfitraCptBundle:Collecteur')->getNb();
        $donateurs = $em->getRepository('AlfitraCptBundle:Donateurs');
        
        $last = $donateurs->findLastInsert();
        if(null != $last){
            $duree = $last->getDate()->diff(new \DateTime());
            $stringDuree = $duree->format('%h heures et %I minutes');
        } else {
            $stringDuree = 'O dons pour le moment ..';
        }
        
        $totalDons = $donateurs->getTotalDefis(1);
        $maxDon = $donateurs->getMax(1);
        $nbDons = $donateurs->getNb(1);
        $totalCb = $donateurs->getTotalCB(1);
        $totalCash = $donateurs->getTotalCash(1);
        return $this->render('AlfitraCptBundle:dashboard:dashboard.html.twig', array(
        	'evnmt' => $evmt,
        	'nbParticipant' => $nbParticipant,
        	'duree' => $stringDuree,
        	'donsTotal' => $totalDons,
        	'max' => $maxDon,
        	'nbDons' => $nbDons,
        	'totalCB' => $totalCb,
        	'totalCash' => $totalCash
        	));
    }

    public function resetAction(){
        $em = $this->getDoctrine()->getManager();
        $donateurs = $em->getRepository('AlfitraCptBundle:Donateurs')->findAll();
        foreach ($donateurs as $don ) {
            $em->remove($don);
        }
        $evmt = $em->getRepository('AlfitraCptBundle:Evenement')->findAll();
        foreach ($evmt as $e) {
            $e->setDebut(new \DateTime());
            $e->setTotalDonateurs(0);
            $e->setTotalDons(0);
            $e->setTotalCash(0);
            $e->setTotalCb(0);
            $e->setTotalChq(0);
            $e->setDonMax(0);
            $em->merge($e);
        }
        $em->flush();
        return $this->indexAction();
        
    }
}
