<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManager): Response
    {
        $contact = new Contact();
        $form = $this->creatForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
             
        }
        return $this->render('contact/index.html.twig', [
            'contact_address' => $this->getParameter('app.contact.address'),
            'contact_phone' => $this->getParameter('app.contact.phone'),
            'contact_email' => $this->getParameter('app.contact.email'),
            'form'=>$form->createView()
        ]);
    }
}
