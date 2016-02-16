<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Request;
use CustomerBundle\Entity\Customer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CustomerController extends Controller
{
    /**
     * @Route("/manage_customer", name="manage_customer")
     */
    public function indexAction(Request $request)
    {   
        $customers = $this->getDoctrine()
                ->getRepository('CustomerBundle:Customer')
                ->findAll();
        
        return $this->render('CustomerBundle:CustomerManage:index.html.twig', [
            'customers' => $customers
        ]);
    }
    
    /**
     * @Route("/manage_customer/create", name="manage_customer_create")
     */
     public function createAction(Request $request)
    {  
        $customer = new Customer;
               
        $form = $this->createFormBuilder($customer)
        ->add('name', TextType::class, ['label' => 'Nazwa firmy', 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('short_name', TextType::class, ['label' => 'Skrócona nazwa firmy','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('nip', TextType::class, ['label' => 'NIP','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('regon', TextType::class, ['label' => 'REGON','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('zip_code', TextType::class, ['label' => 'Kod pocztowy','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('city', TextType::class, ['label' => 'Miasto','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('country', TextType::class, ['label' => 'Kraj','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('number_house', TextType::class, ['label' => 'Numer budynku','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('number_apartament', TextType::class, ['label' => 'Nr lokalu','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('web_page', TextType::class, ['label' => 'Strona internetowa','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('email', TextType::class, ['label' => 'email','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('phone_number', TextType::class, ['label' => 'Numer telefonu','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('payment', EntityType::class, [
            'label' => 'Wybierz płatność',
            'class' => 'CustomerBundle:Payment',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])
        ->add('discount', EntityType::class, [
            'label' => 'Wybierz rabat dla klienta',
            'class' => 'CustomerBundle:Discount',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])
        ->add('customer_type', EntityType::class, [ 
            'label' => 'Wybierz formę działalności klienta',
            'class' => 'CustomerBundle:CustomerType',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])
                /*      
        ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))*/
        
        ->add('save', SubmitType::class, ['label' => 'Stworz', 'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']])
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // get data
            $name = $form['name']->getData();
            $short_name = $form['short_name']->getData();
            $nip = $form['nip']->getData();
            $regon = $form['regon']->getData();
            $city = $form['city']->getData();
            $number_house = $form['number_house']->getData();
            $number_apartament = $form['number_apartament']->getData();
            $web_page = $form['web_page']->getData();
            $email  = $form['email']->getData();
            $phone_number = $form['phone_number']->getData();
            $payment = $form['payment']->getData();
            $discount = $form['discount']->getData();
            $customer_type = $form['customer_type']->getData();
            $now = new\DateTime('now');
            $userId = $this->getUser()->getId();




            $customer->setName($name);
            $customer->setShortName($short_name);
            $customer->setNip($nip);
            $customer->setRegon($regon);
            $customer->setCity($city);
            $customer->setNumberHouse($number_house);
            $customer->setNumberApartament($number_apartament);
            $customer->setWebPage($web_page);
            $customer->setEmail($email);
            $customer->setPhoneNumber($phone_number);
            $customer->setDateAdd($now);
            $customer->setPayment($payment);
            $customer->setDiscount($discount);
            $customer->setCustomerType($customer_type);
            $customer->setUserId($userId);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            $this->addFlash(
                'notice',
                'Dodany nowego klienta'
                );
             return $this->redirectToRoute('manage_customer');
        }


        return $this->render('CustomerBundle:CustomerManage:create.html.twig', [
            'form' => $form->createView()
            ]);
    }
    
     /**
     * @Route("/manage_customer/details/{id}", name="manage_customer_details")
     */
    public function detailsAction($id)
    {
        
        $customer = $this->getDoctrine()
            ->getRepository('CustomerBundle:Customer')
            ->find($id);
        
        $notes = $this->getDoctrine()
            ->getRepository('CustomerBundle:Note')
            ->findByCustomer($id);
        
        $payment = $customer->getPayment();
        $discount = $customer->getDiscount();
        $customertype = $customer->getCustomerType();
        
        return $this->render('CustomerBundle:CustomerManage:details.html.twig', 
            ['customer' => $customer,
             'payment' => $payment,
             'notes' => $notes,
             'discount' => $discount,
             'customertype' => $customertype,
             'notes' => $notes,
                ]);
    }
    
    /**
     * @Route("/manage_customer/details/delete/{id}", name="klienci_details_delete")
     */
    public function deleteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('CustomerBundle:Customer')->find($id);

            $em->remove($customer);
            $em->flush();

            $this->addFlash(
                'notice',
                'Skasowano klienta'
                );
             return $this->redirectToRoute('manage_customer');

    }
    /**
     * @Route("/manage_customer/details/edit/{id}", name="manage_customer_edit")
     */    
     public function editAction($id, Request $request)
    {  
         
        $customer = $this->getDoctrine()
                ->getRepository('CustomerBundle:Customer')
                ->find($id);
        
        $now = new\DateTime('now');
        
        
          $customer->setName($customer->getName());
            $customer->setShortName($customer->getShortName());
            $customer->setNip($customer->getNip());
            $customer->setRegon($customer->getRegon());
            $customer->setCity($customer->getCity());
            $customer->setNumberHouse($customer->getNumberHouse());
            $customer->setNumberApartament($customer->getNumberApartament());
            $customer->setWebPage($customer->getWebPage());
            $customer->setEmail($customer->getEmail());
            $customer->setPhoneNumber($customer->getPhoneNumber());
            
            $customer->setPayment($customer->getPayment());
            $customer->setDiscount($customer->getDiscount());
            $customer->setCustomerType($customer->getCustomerType());
           
      
               
        
        
        $form = $this->createFormBuilder($customer)
        ->add('name', TextType::class, ['label' => 'Nazwa firmy', 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('short_name', TextType::class, ['label' => 'Skrócona nazwa firmy','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('nip', TextType::class, ['label' => 'NIP','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('regon', TextType::class, ['label' => 'REGON','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('zip_code', TextType::class, ['label' => 'Kod pocztowy','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('city', TextType::class, ['label' => 'Miasto','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('country', TextType::class, ['label' => 'Kraj','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('number_house', TextType::class, ['label' => 'Numer budynku','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('number_apartament', TextType::class, ['label' => 'Nr lokalu','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('web_page', TextType::class, ['label' => 'Strona internetowa','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('email', TextType::class, ['label' => 'email','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('phone_number', TextType::class, ['label' => 'Numer telefonu','attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])
        ->add('payment', EntityType::class, [
            'label' => 'Wybierz płatność',
            'class' => 'CustomerBundle:Payment',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])
        ->add('discount', EntityType::class, [
            'label' => 'Wybierz rabat dla klienta',
            'class' => 'CustomerBundle:Discount',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])
        ->add('customer_type', EntityType::class, [ 
            'label' => 'Wybierz formę działalności klienta',
            'class' => 'CustomerBundle:CustomerType',
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']
             ])

        ->add('save', SubmitType::class, ['label' => 'Edytuj', 'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']])
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // get data
            $name = $form['name']->getData();
            $short_name = $form['short_name']->getData();
            $nip = $form['nip']->getData();
            $regon = $form['regon']->getData();
            $city = $form['city']->getData();
            $number_house = $form['number_house']->getData();
            $number_apartament = $form['number_apartament']->getData();
            $web_page = $form['web_page']->getData();
            $email  = $form['email']->getData();
            $phone_number = $form['phone_number']->getData();
            $payment = $form['payment']->getData();
            $discount = $form['discount']->getData();
            $customer_type = $form['customer_type']->getData();

            $em =$this->getDoctrine()->getManager();
            $customer = $em->getRepository('CustomerBundle:Customer')->find($id);


            $customer->setName($name);
            $customer->setShortName($short_name);
            $customer->setNip($nip);
            $customer->setRegon($regon);
            $customer->setCity($city);
            $customer->setNumberHouse($number_house);
            $customer->setNumberApartament($number_apartament);
            $customer->setWebPage($web_page);
            $customer->setEmail($email);
            $customer->setPhoneNumber($phone_number);
            $customer->setDateAdd($now);
            $customer->setPayment($payment);
            $customer->setDiscount($discount);
            $customer->setCustomerType($customer_type);
 
            
           
            $em->flush();

            $this->addFlash(
                'notice',
                'Edytowano klienta'
                );
//             return $this->redirectToRoute('manage_customer');
        }


        return $this->render('CustomerBundle:CustomerManage:edit.html.twig', [
            'customer' => $customer,
            'form' => $form->createView()
            ]);
    }

    
     /**
     * @Route("/manage_customer/details/delete/{id}/deletenote/$aa", name="deletenote")
     */
    public function deletenoteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('CustomerBundle:Customer')->find($id);
            
            $notes = $bb->getRepository('CustomerBundle:Note')->find($id);
            
            $bb->remove($notes);
            $bb->flush();
            
            $payment = $customer->getPayment();
            $discount = $customer->getDiscount();
            $customertype = $customer->getCustomerType();
            $this->addFlash(
                'notice',
                'Skasowano notatke'
                );
                     
        return $this->render('CustomerBundle:CustomerManage:details.html.twig', 
            ['customer' => $customer,
             'payment' => $payment,
             'notes' => $notes,
             'discount' => $discount,
             'customertype' => $customertype,
             'notes' => $notes,
                ]);

    }
}
