<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if (  $form->isValid() && ) {
            $entityManager->persist($contact);
            $entityManager->flush();

            $email = new Email();
            $email->from($contact->getEmail());
            $email->to($this->getParameter('app.contact.email'));
            $email->replyTo($this->getParameter('app.contact.email'));
            $email->subject($this->getParameter('app.contact.subject'));
            $email->html($contact->getParameter() );
            $mailer->send($email);

            $this->addFlash('success','votre message a bien été envoyé'); 

            return $this->redirectToRoute('app_home_page');
            
        }
        return $this->render('contact/index.html.twig', [
            'contact_address' => $this->getParameter('app.contact.address'),
            'contact_phone' => $this->getParameter('app.contact.phone'),
            'contact_email' => $this->getParameter('app.contact.email'),
            'form'=>$form->createView()
        ]);
    }
}
