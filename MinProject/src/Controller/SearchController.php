<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request ,AuteurRepository $auteurRepository, CategorieRepository $categorieRepository,LivreRepository $livreRepository): Response
    {
        //On recupere les filtres
        $filters = $request->get("categories");
        
        //On verifie si on a une requete Ajax 
        if($request->get('ajax')){
            return "Ok";
        }
        
        $livres = $livreRepository->getlivrefilters($filters);

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'auteurs' => $auteurRepository->findAll(),      
            'categories' => $categorieRepository->findAll(),      
            'livres' => $livreRepository->findAll(),      
        ]);
    }
}
