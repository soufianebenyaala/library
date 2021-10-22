<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description'),
            ImageField::new('image')
            ->setBasePath('images/book')
            ->setUploadDir('public/images/book')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            NumberField::new('prix'),
            NumberField::new('qte_stock'),
            AssociationField::new('auteur','Auteur'),
            AssociationField::new('categorie'),
            AssociationField::new('editeur'),
            DateField::new('date_edition'),
            TextField::new('nbr_page','Nombre de page'),
            TextField::new('isbn'),
            TextField::new('language'),


        ];
    }
}
