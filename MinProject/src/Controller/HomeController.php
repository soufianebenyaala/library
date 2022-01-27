<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SearchBarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;

use Symfony\Component\HttpFoundation\JsonResponse;




class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request,AuteurRepository $auteurRepository, CategorieRepository $categorieRepository,LivreRepository $livreRepository): Response
    {
        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('search', [
                "search"=> $form->get('field_name')->getData()
            ],);
        }
        return $this->renderForm('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'auteurs' => $auteurRepository->findAll(),     
            'categories' => $categorieRepository->findAll(),      
            'livres' => $livreRepository->findAll(),  
            'form' => $form,
        ]);
      
    }



}
