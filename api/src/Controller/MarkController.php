<?php

// src/Controller/ProcessController.php

namespace App\Controller;


use Conduction\CommonGroundBundle\Service\ApplicationService;
//use App\Service\RequestService;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The Procces controller handles any calls that have not been picked up by another controller, and wel try to handle the slug based against the wrc.
 *
 * Class ProcessController
 *
 * @Route("/mark")
 */
class MarkController extends AbstractController
{
    /**
     * This function shows all available processes.
     *
     * @Route("/")
     * @Template
     */
    public function indexAction(CommonGroundService $commonGroundService)
    {
        $variables = [];
        $variables['templates'] = $commonGroundService->getResourceList(['component' => 'wrc','type' => 'templates'])['hydra:member'];

        return $variables;
    }

    /**
     * This function shows all available processes.
     *
     * @Route("/cookies")
     * @Template
     */
    public function cookiesAction(CommonGroundService $commonGroundService){
        $variables = [];
        $variables['templates'] = $commonGroundService->getResourceList(['component' => 'wrc','type' => 'templates'],['name' => 'cookies'])['hydra:member'];

        return $variables;
    }


    /**
     * This function shows all available processes.
     *
     * @Route("/nieuws")
     * @Template
     */
    public function nieuwsAction(CommonGroundService $commonGroundService){
        $variables = [];
        $variables['templates'] = $commonGroundService->getResourceList(['component' => 'wrc','type' => 'templates'],['limit' => 3, 'templateGroups.name' => 'Nieuws', 'order[dateCreated]'=>'desc'])['hydra:member'];

        return $variables;
    }

    /**
     * This function shows all available processes.
     *
     * @Route("/nieuws/{id}")
     * @Template
     */
    public function nieuwAction(CommonGroundService $commonGroundService, $id){
        $variables = [];
        $variables['newsitem'] = $commonGroundService->getResource(['component' => 'wrc','type' => 'templates','id'=>$id]);

        return $variables;
    }

    /**
     * This function shows all available processes.
     *
     * @Route("/jobs")
     * @Template
     */
    public function jobsAction(CommonGroundService $commonGroundService){
        $variables = [];
        $variables['baan'] = $commonGroundService->getResourceList(['component' => 'mrc','type' => 'job_functions'])['hydra:member'];

        return $variables;
    }

    /**
     * This function shows all available processes.
     *
     * @Route("/jobs/{id}")
     * @Template
     */
    public function baanAction(CommonGroundService $commonGroundService, $id){
        $variables = [];
        $variables['baan'] = $commonGroundService->getResource(['component' => 'mrc','type' => 'job_functions','id' => $id]);

        return $variables;
    }

}
