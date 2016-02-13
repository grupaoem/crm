<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use CustomerBundle\Entity\Discount;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DiscountController extends Controller
{
        /**
     * @Route("/manage_customer/discount", name="discount")
     */
    public function indexAction(Request $request)
    {
        $discounts = $this->getDoctrine()
                ->getRepository('CustomerBundle:Discount')
                ->findAll();
        
        
        return $this->render('CustomerBundle:Discount:index.html.twig', array(
            'discounts' => $discounts 
        ));
    }

        /**
     * @Route("/manage_customer/discount/create", name="discount_create")
     */    
    
    public function createAction(Request $request){
        $discount = new Discount;
        
        $form = $this->createFormBuilder($discount)
                ->add('name', TextType::class, array('label' => 'Nazwa rabatu', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('value', TextType::class, array('label' => 'Wartość', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('save', SubmitType::class, array('label' => 'Stworz', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name'] ->getData();
            $value = $form['value'] ->getData();
            
            $discount->setName($name);
            $discount->setValue($value);
           
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($discount);
            $em->flush();
            
            $this->addFlash(
                    'notice',
                    'Dodaną nowy rabat');
            return $this->redirectToRoute('discount');
        }
        
        return $this->render('CustomerBundle:Discount:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
            /**
     * @Route("/manage_customer/discount/delete/{id}", name="discount_delete")
     */    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $discount = $em->getRepository('CustomerBundle:Discount')->find($id);
        
        $em->remove($discount);
        $em->flush();
        
        $this->addFlash(
                'notice',
                'Skasowano rabat'
                );
        return $this->redirectToRoute('discount');
    }
    
}
