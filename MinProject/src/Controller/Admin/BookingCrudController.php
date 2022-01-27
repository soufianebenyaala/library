<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $bookReturned = Action::new('book Returned', 'comfirme book Returned')
            ->linkToCrudAction('bookReturned');
    
        return $actions
            ->add(Crud::PAGE_INDEX, $bookReturned);
    }

    public function bookReturned(AdminContext $context)
    {  
        
        $id     = $context->getRequest()->query->get('entityId');
        $booking = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        $livre = $this->getDoctrine()->getRepository(Livre::class)->find($booking->getLivreId());

        $booking->setReturnDate(new \DateTime('now'));
        $livre->addDeQteStock();

        $em = $this->getDoctrine()->getManager();

        $em->flush();

        return $this->render('admin/dashboard.html.twig');
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
