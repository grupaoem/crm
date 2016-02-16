<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;


use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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

    
        public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }
}
