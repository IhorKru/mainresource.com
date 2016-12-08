<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\InputType;
use AppBundle\Entity\CampaignInputDetails;
use AppBundle\Services\ADKController;
use AppBundle\Services\AdKnowledgeQuery;

class BackEndController extends Controller
{
    /**
     * @Route("campaigns", name="campaigns")
     */
    public function campaignsAction(Request $request)
    {   

        $newInputs = new CampaignInputDetails();

        $form = $this->createForm(InputType::class, $newInputs, [
            'action' => $this -> generateUrl('campaigns'),
            'method' => 'POST'
            ]);
        
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()) {
            $partner = $form['partnername']->getData();
            //$resourceid = $form['resourcename']->getData();
            $templateid = $form['templatename']->getData();
            $numcampaigns = $form['numemails']->getData();

            if($partner == 1 and is_null($templateid)) {
               $partnername = "AdKnowledge";
               $getcampaign = $this->get('api.adk');
               $subscriberst = $getcampaign -> ADKAction($numcampaigns);
            }

            //generating successfull responce page
            return $this->render('BackEnd/apisuccess.html.twig',[
                'partnername' => $partnername,
                'numsubscribers' => $subscriberst[0]]);
        }

        return $this->render('BackEnd/campaign.html.twig',[
            'form'=>$form->createView()]);
    }
}
