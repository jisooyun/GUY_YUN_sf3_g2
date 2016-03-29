<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */

    public function indexAction()
    {
        //return $this->render('AppBundle:Default:index.html.twig');
        return new Response('Coucou Jisoo');
    }
}
