<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Security:login.html.twig');
    }
#    public function indexAction()
#    {
    /*    $user = $this->get('security.context')->getToken()->getUser();
        var_dump($user);die;*/
 #       return $this->render('UserBundle:Security:login.html.twig');

        
 #   }
    
         /**
     * @Route("/zarzadzaj", name="zarzadzaj")
     */
    public function manageUsersAction(){
        return $this->render('UserBundle:Default:index.html.twig');
        
    }
}
