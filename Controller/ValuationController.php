<?php

namespace Aiapps\ValuationFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;


class ValuationController extends Controller
{
    private $templating;
    private $kernel;

    public function __construct(EngineInterface $templating, $kernel)
    {
        $this->templating = $templating;
        $this->kernel = $kernel;
    }

    public function showValuation() {

        $apikey = $this->kernel->getContainer()->getParameter('aiapps_valuation_form.parameters.apikey');
        $email = $this->kernel->getContainer()->getParameter('aiapps_valuation_form.parameters.email');
        $terms = $this->kernel->getContainer()->getParameter('aiapps_valuation_form.parameters.terms');

//        $apikey = $this->kernel->getContainer()->getParameter('valuation.form.apikey');
//        $email = $this->kernel->getContainer()->getParameter('valuation.form.email');
//        $terms = $this->kernel->getContainer()->getParameter('valuation.form.terms');

//        $apikey = '9f83d4db086f23069633127ef77688da9a5ed496';
//        $email = 'mmira@staiapps.com';
//        $terms = 'http://staiapps.com/es/aviso-legal/';

        $template = $this->templating->renderResponse('AiappsValuationFormBundle:Default:index.html.twig', array(
            'apikey' => $apikey,
            'email' => $email,
            'terms' => $terms
        ));

        return $template->getContent();
    }
}
