<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use App\Entity\Booking;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Livre;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{

     #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return  $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MinProject');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Auteur', 'fas fa-user-cog', Auteur::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Editeur', 'fas fa-user-edit', Editeur::class);
        yield MenuItem::linkToCrud('Livre', 'fas fa-book', Livre::class);
        yield MenuItem::linkToCrud('Reservation', 'fas fa-cart-arrow-down', Booking::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
