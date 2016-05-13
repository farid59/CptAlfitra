<?php

namespace Alfitra\CptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Alfitra\CptBundle\Entity\Donateurs;
use Alfitra\CptBundle\Form\DonateursType;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;


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
        if(count($donsParCollecteur)>0) {
            dump($donsParCollecteur);
            $superCollecteur = $donsParCollecteur[0][1];
            $faibleCollecteur = $donsParCollecteur[0][1];
            for ($i=0; $i < count($donsParCollecteur); $i++) { 
                if ($donsParCollecteur[$i][1] > $superCollecteur) 
                    $superCollecteur = $donsParCollecteur[$i][1];
                if ($donsParCollecteur[$i][1] < $faibleCollecteur) 
                    $faibleCollecteur = $donsParCollecteur[$i][1];
            }
        } else {
            $superCollecteur = -1;
            $faibleCollecteur = -1;
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

    public function sellsHistoryAction()
    {

        $em = $this->getDoctrine()->getManager();
        $dons_repository = $em->getRepository('AlfitraCptBundle:Donateurs');
        $day = date('d');
        $donByHours = $dons_repository->getDonsByDaysAndHours($day);
        
        dump($donByHours);
        $dataDonCB = array();
        $dataDonCash = array();
        $dataHours = array();
        $j = 9;
        for ($i=0; $i < count($donByHours) ; $i++) { 
            if($donByHours[$i]['type'] ==  "Visa")
                array_push($dataDonCB, intval($donByHours[$i]['nb']));
            if($donByHours[$i]['type'] ==  "Cash")
                array_push($dataDonCash, intval($donByHours[$i]['nb']));
            if(!in_array($donByHours[$i]['hour'], $dataHours))
                array_push($dataHours, $donByHours[$i]['hour']);
        }
        //dump($donByHours);die();
        $dates = array(
            "9", "10","11", "12", "13", "14", "15", "16","17","18","19","20","21","22","23"
        );
        $dataCB = array();
        $dataCash = array();
        $indice = 0;
        for ($i=0; $i < count($dates); $i++) { 
            if(!$this->contains($dates[$i],$donByHours)){
                array_push($dataCash,0);
                array_push($dataCB,0);
            } else {  
            $boolCB = false;
            $boolCash = false;
            for ($j=0; $j < count($donByHours); $j++) { 
                if(($donByHours[$j]['hour'] == $dates[$i]) && ($donByHours[$j]['type'] ==  "Visa")){
                        array_push($dataCB, intval($donByHours[$j]['nb']));
                        $boolCB = true;
                    }
                if(($donByHours[$j]['hour'] == $dates[$i]) && ($donByHours[$j]['type'] ==  "Cash")){
                        array_push($dataCash, intval($donByHours[$j]['nb']));
                        $boolCash = true;
                    }
                }
            if(!$boolCB) array_push($dataCB,0);
            if(!$boolCash) array_push($dataCash,0);
            }
        }

        // Chart
        $sellsHistory = array(
            array(
                 "name" => "Dons CB",
                 "data" => $dataCB
            ),
            array(
                 "name" => "Dons Cash",
                 "data" => $dataCash
            ),

        );



        // $dates = $dataHours;
        dump($dataCash);
        dump($dataCB);

        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('linechart');
        $ob->title->text('Évolution des dons');

        $ob->yAxis->title(array('text' => "Montant des dons (en €)"));

        $ob->xAxis->title(array('text'  => "Heure"));
        $ob->xAxis->categories($dates);

        $ob->series($sellsHistory);

        return $this->render('AlfitraCptBundle:donateur:chart.html.twig', array(
            'chart' => $ob
        ));
    }

    public function contains($value,$tab){
        for ($i=0; $i < count($tab) ; $i++) { 
            if(in_array($value, $tab[$i]))
                return true;
        }
        return false;
    }
}
