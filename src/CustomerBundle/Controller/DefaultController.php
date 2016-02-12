<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/manage_customer", name="manage_customer")
     */
    public function indexAction()
    {
        return $this->render('CustomerBundle:Default:index.html.twig');
    }
}
