<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
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
            ->setEntityLabelInPlural('tags')
            ->setEntityLabelInSingular('tag')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail d\'un %entity_label_singular%')
            ;
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('label')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Attributs'),
            IdField::new('id', "#")->hideOnForm()->hideOnDetail()->hideOnIndex(),
            TextField::new('label', 'Libellé'),
        ];
    }
}
