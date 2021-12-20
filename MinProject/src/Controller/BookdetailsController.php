<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookdetailsController extends AbstractController
{
    #[Route('/bookdetails/{id}', name: 'bookdetails',methods: ['GET','POST'])]
    public function index(Request $request,AuteurRepository $auteurRepository, CategorieRepository $categorieRepository,Livre $livre,ReviewRepository $reviews): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setLivre($livre)
                    ->setUser($this->getUser())
                    ->setCreateAt(new \DateTime());
                   
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('bookdetails', ['id'=>$livre->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bookdetails/index.html.twig', [
            'controller_name' => 'BookdetailsController',
            'auteurs' => $auteurRepository->findAll(),      
            'categories' => $categorieRepository->findAll(),      
            'reviews' => $reviews->findAll(),   
            'livre' => $livre,  
            'review' => $review,
            'form' => $form,
            
        ]);
    }


}
