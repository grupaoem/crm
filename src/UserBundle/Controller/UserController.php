<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
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
     * @Route("/manage_users", name="manage_users")
     */
    public function manageUsersAction(Request $request){
        
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('UserBundle:UserManagement:index.html.twig', 
            ['users' => $users,]
                );
      
        
    }
    
     /**
     * @Route("/manage_users/details/{id}", name="manage_users_details")
     */
    public function manageUsersDetailsAction($id)
    {
        
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$id));
 
        return $this->render('UserBundle:Profile:show.html.twig',
            ['user' => $user,]);
        
          
    }

}
