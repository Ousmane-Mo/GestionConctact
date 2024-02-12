<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Repository\ContactsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts", methods={'GET'})
     */
    public function ContactsList(ContactsRepository $repo): Response
    {
        $contacts = $repo->findAll();
        dump($contacts);
        return $this->render('contacts/ContactsList.html.twig', [
            /* 'controller_name' => 'ContactsController', */
            'contacts' => $contacts
        ]);
    }
    /**
     * @Route("/contact/{id}", name="contact" methods={'GET'})
     */
    public function ContactInfos( $id, ContactsRepository $repo): Response
    {
        $contact = $repo->find($id);
        return $this->render('contacts/ContactInfo.html.twig', [
            /* 'controller_name' => 'ContactsController', */
            'selecContact' => $contact
        ]);
    }
}
