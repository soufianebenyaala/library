<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookdetailsController extends AbstractController
{
    #[Route('/bookdetails', name: 'bookdetails')]
    public function index(): Response
    {
        return $this->render('bookdetails/index.html.twig', [
            'controller_name' => 'BookdetailsController',
        ]);
    }
}
