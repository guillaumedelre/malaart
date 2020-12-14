<?php

namespace App\Controller\Admin;

use App\Entity\Purchase;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PurchaseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Purchase::class;
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
            ->setEntityLabelInPlural('achats')
            ->setEntityLabelInSingular('achat')
            ->setPageTitle(Crud::PAGE_INDEX, 'Historique des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail d\'une %entity_label_singular%')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('units')
            ->add('price')
            ->add('purchasedAt')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield FormField::addPanel('Achat');
                yield AssociationField::new('material', 'Fourniture achetée')->setCrudController(MaterialCrudController::class);
                yield IntegerField::new('units', 'Unités');
                yield AssociationField::new('supplier', 'Fournisseur')->setCrudController(SupplierCrudController::class);
                yield MoneyField::new('price', 'Prix total')->setCurrency('EUR')->setStoredAsCents(false);
                yield DateTimeField::new('purchasedAt', 'Date d\'achat');
                yield ImageField::new('image', 'Photo')->setUploadDir('public/uploads');
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield FormField::addPanel('Achat');
                yield IdField::new('id', '#')->hideOnForm();
                yield AssociationField::new('material', 'Fourniture achetée')->setCrudController(MaterialCrudController::class)->setRequired(true);
                yield IntegerField::new('units', 'Unités');
                yield AssociationField::new('supplier', 'Fournisseur')->setCrudController(SupplierCrudController::class)->setRequired(true);
                yield MoneyField::new('price', 'Prix total')->setCurrency('EUR')->setStoredAsCents(false);
                yield DateTimeField::new('purchasedAt', 'Date d\'achat');
                yield ImageField::new('image', 'Photo')->setUploadDir('public/uploads');
                break;
            case Crud::PAGE_INDEX:
                yield AssociationField::new('material', 'Fourniture achetée')->setCrudController(MaterialCrudController::class);
                yield IntegerField::new('units', 'Unités');
                yield AssociationField::new('supplier', 'Fournisseur')->setCrudController(SupplierCrudController::class);
                yield MoneyField::new('price', 'Prix total')->setCurrency('EUR')->setStoredAsCents(false);
                yield DateTimeField::new('purchasedAt', 'Date d\'achat');
                yield ImageField::new('image', 'Photo')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return "https://localhost/uploads$value";
                    }
                );
                break;
        }
    }
}
