<?php

namespace App\Controller;

use App\Controller\ContactsController;
use App\Repository\CategoryRepository;
use App\Repository\ContactsRepository;
use Container1ADxwLY\getContactsControllerService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function CategoriesList(CategoryRepository $repo): Response
    {
        $categories = $repo->findAll();
        return $this->render('category/CategoriesList.html.twig', [
            /* 'controller_name' => 'CategoryController', */
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="category", methods={"GET"})
     */
    public function CategoryInfo($id, CategoryRepository $repo, ContactsRepository $contactsRepository): Response
    {

        $category = $repo->find($id);  
        $contacts = $contactsRepository->findBy([
            'categorie'=> $id],
            ['name'=> 'ASC']
        );

        return $this->render('category/CategoryInfo.html.twig', [
            /* 'controller_name' => 'CategoryController', */
            'category' => $category,
            'contacts' => $contacts,
        ]);
    }
}
