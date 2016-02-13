<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use CustomerBundle\Entity\CustomerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CustomerTypeController extends Controller
{
        /**
     * @Route("/manage_customer/customer_type", name="customer_type")
     */
    public function indexAction(Request $request)
    {
        $customer_types = $this->getDoctrine()
                ->getRepository('CustomerBundle:CustomerType')
                ->findAll();
        
        
        return $this->render('CustomerBundle:CustomerType:index.html.twig', array(
            'customer_types' => $customer_types
        ));
    }

        /**
     * @Route("/manage_customer/customer_type/create", name="customer_type_create")
     */    
    
    public function createAction(Request $request){
        $customer_type = new CustomerType;
        
        $form = $this->createFormBuilder($customer_type)
                ->add('name', TextType::class, array('label' => 'Nazwa rodzaju działalnosci', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('save', SubmitType::class, array('label' => 'Stworz', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name'] ->getData();
            
            $customer_type->setName($name);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer_type);
            $em->flush();
            
            $this->addFlash(
                    'notice',
                    'Dodaną nowy rodzaj działalnosci');
            return $this->redirectToRoute('customer_type');
        }
        
        return $this->render('CustomerBundle:CustomerType:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
            /**
     * @Route("/manage_customer/customer_type/delete/{id}", name="customer_type_delete")
     */    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $customer_type = $em->getRepository('CustomerBundle:CustomerType')->find($id);
        
        $em->remove($customer_type);
        $em->flush();
        
        $this->addFlash(
                'notice',
                'Skasowano płatność'
                );
        return $this->redirectToRoute('customer_type');
    }
    
}
