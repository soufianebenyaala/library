<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request ,AuteurRepository $auteurRepository, CategorieRepository $categorieRepository,LivreRepository $livreRepository): Response
    {
        $searchh = $request->query->get('search');
        //On recupere les filtres
        $filters = $request->get("categories");
        
        $livres = $livreRepository->getlivrefilters($filters,$searchh);
      
        
        
        //On verifie si on a une requete Ajax 
        if($request->get('ajax')){
            
            return new JsonResponse(
                [
                    'content' => $this->renderView('search/_content.html.twig', [
                        'controller_name' => 'SearchController',
                        'auteurs' => $auteurRepository->findAll(),           
                        'livres' => $livres,    
                    ])
                ]
            );
        }
        
    

     
    

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'auteurs' => $auteurRepository->findAll(),      
            'categories' => $categorieRepository->findAll(),      
            'livres' => $livres,      
        ]);
    }
}
