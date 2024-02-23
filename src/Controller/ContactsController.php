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
     * @Route("/contacts", name="contacts", methods={"GET"})
     */
    public function ContactsList(ContactsRepository $repo): Response
    {
        $contacts = $repo->findAll();
        return $this->render('contacts/ContactsList.html.twig', [
            /* 'controller_name' => 'ContactsController', */
            'contacts' => $contacts
        ]);
    }
    /**
     * @Route("/contactsgender/{sex}", name="contactsgender", methods={"GET"})
     */
    public function ContactsGender($sex, ContactsRepository $repo): Response
    {
        $contacts = $repo->findBy([
            'sex'=> $sex],
            ['name'=> 'ASC']
        );
        return $this->render('contacts/ContactsList.html.twig', [
            /* 'controller_name' => 'ContactsController', */
            'contacts' => $contacts
        ]);
    }
    /**
     * @Route("/contact/{id}", name="contact", methods={"GET"})
     */
    public function ContactInfos( $id, ContactsRepository $repo): Response
    {
        $contact = $repo->find($id);
        return $this->render('contacts/ContactInfo.html.twig', [
            /* 'controller_name' => 'ContactsController', */
            'contact' => $contact
        ]);
    }
}
