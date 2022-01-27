<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request ,AuteurRepository $auteurRepository, CategorieRepository $categorieRepository,LivreRepository $livreRepository): Response
    {
        
        
        return $this->render('home/index.html.twig', [
            
            'auteurs' => $auteurRepository->findAll(),     
            'categories' => $categorieRepository->findAll(),      
            'livres' => $livreRepository->findAll(),      
        ]);
      
    }



}
