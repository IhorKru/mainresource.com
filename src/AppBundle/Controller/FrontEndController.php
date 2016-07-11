<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Swift_Message;

class FrontEndController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        //CONTACT FORM
        $newContact = new Contact();
        $form2 = $this->createForm(ContactType::class, $newContact, [
            'action' => $this -> generateUrl('index'),
            'method' => 'POST'
        ]);

        $form2->handleRequest($request);

        if($form2->isValid() && $form2->isSubmitted()) {
            $name = $form2['name'] ->getData();
            $emailaddress = $form2['emailaddress'] ->getData();
            $subject = $form2['subject'] ->getData();
            $message = $form2['message'] ->getData();

            $newContact ->setName($name);
            $newContact ->setEmailAddress($emailaddress);
            $newContact ->setSubject($subject);
            $newContact ->setMessage($message);

            //create email

            $message = Swift_Message::newInstance()
                ->setSubject('Mediaff.com | Question from Website |')
                ->setFrom($newContact->getEmailAddress())
                ->setTo('kruchynenko@gmail.com')
                ->setContentType("text/html")
                ->setBody($newContact->getMessage());

            //send email
            $this->get('mailer')->send($message);
            //generating successfull responce page
            return $this->redirect($this->generateUrl('index'));

         }
         
        return $this->render('FrontEnd/index.html.twig', [
            'form2' => $form2->createView()
        ]);
    }
    
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        $newContact = new Contact();
        $form2 = $this->createForm(ContactType::class, $newContact, [
            'action' => $this -> generateUrl('index'),
            'method' => 'POST'
        ]);
        // replace this example code with whatever you need
        return $this->render('FrontEnd/about.html.twig', [
            'form2' => $form2 -> createView()
        ]);
    }
    
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $newContact = new Contact();
        $form2 = $this->createForm(ContactType::class, $newContact, [
            'action' => $this -> generateUrl('index'),
            'method' => 'POST'
        ]);
        // replace this example code with whatever you need
        return $this->render('FrontEnd/contact.html.twig', [
            'form2' => $form2->createView()
        ]);
    }
    
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolioAction(Request $request)
    {
        $newContact = new Contact();
        $form2 = $this->createForm(ContactType::class, $newContact, [
            'action' => $this -> generateUrl('index'),
            'method' => 'POST'
        ]);
        // replace this example code with whatever you need
        return $this->render('FrontEnd/portfolio.html.twig', [
            'form2' => $form2->createView()
        ]);
    }
    
    /**
     * @Route("/services", name="services")
     */
    public function servicesAction(Request $request)
    {
        $newContact = new Contact();
        $form2 = $this->createForm(ContactType::class, $newContact, [
            'action' => $this -> generateUrl('index'),
            'method' => 'POST'
        ]);
        // replace this example code with whatever you need
        return $this->render('FrontEnd/services.html.twig', [
            'form2' => $form2->createView()
        ]);
    }
}