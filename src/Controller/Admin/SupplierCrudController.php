<?php

namespace App\Controller\Admin;

use App\Entity\Supplier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class SupplierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Supplier::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('fournisseurs')
            ->setEntityLabelInSingular('fournisseur')
            ->setPageTitle(Crud::PAGE_INDEX, 'Catalogue de %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail d\'un %entity_label_singular%')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('url')
            ->add('tags')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield FormField::addPanel('Attributs');
                yield TextField::new('name', 'Nom');
                yield UrlField::new('url', 'Site internet');
                yield ArrayField::new('purchases', 'Achats');
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield FormField::addPanel('Attributs');
                yield IdField::new('id', "#")->hideOnForm();
                yield TextField::new('name', 'Nom');
                yield UrlField::new('url', 'Site internet');
                yield AssociationField::new('tags', 'Tags')->setCrudController(TagCrudController::class);
                break;
            case Crud::PAGE_INDEX:
                yield TextField::new('name', 'Nom');
                yield UrlField::new('url', 'Site internet');
                yield AssociationField::new('purchases', 'Achats')->setCrudController(PurchaseCrudController::class);
                break;
        }
    }
}
