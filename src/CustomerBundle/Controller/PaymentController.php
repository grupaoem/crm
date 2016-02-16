<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use CustomerBundle\Entity\Payment;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PaymentController extends Controller
{
        /**
     * @Route("/manage_customer/payment", name="payment")
     */
    public function indexAction(Request $request)
    {
        $payments = $this->getDoctrine()
                ->getRepository('CustomerBundle:Payment')
                ->findAll();
        
        
        return $this->render('CustomerBundle:Payment:index.html.twig', ['payments' => $payments]);
    }

        /**
     * @Route("/manage_customer/payment/create", name="payment_create")
     */    
    
    public function createAction(Request $request){
        $payment = new Payment;
        
        $form = $this->createFormBuilder($payment)
                ->add('name', TextType::class, ['label' => 'Nazwa platnosci', 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']])
                ->add('save', SubmitType::class, ['label' => 'Stworz', 'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']])
                ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form['name'] ->getData();
            
            $payment->setName($name);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();
            
            $this->addFlash(
                    'notice',
                    'Dodaną nową płatnośćć');
            return $this->redirectToRoute('payment');
        }
        
        return $this->render('CustomerBundle:Payment:create.html.twig', ['form' => $form->createView()]);
       
    }
    
            /**
     * @Route("/manage_customer/payment/delete/{id}", name="payment_delete")
     */    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $payment = $em->getRepository('CustomerBundle:Payment')->find($id);
        
        $em->remove($payment);
        $em->flush();
        
        $this->addFlash(
                'notice',
                'Skasowano płatność'
                );
        return $this->redirectToRoute('payment');
    }
    
}
