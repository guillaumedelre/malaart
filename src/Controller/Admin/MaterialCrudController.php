<?php

namespace App\Controller\Admin;

use App\Entity\Material;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class MaterialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Material::class;
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
            ->setEntityLabelInPlural('fournitures')
            ->setEntityLabelInSingular('fourniture')
            ->setPageTitle(Crud::PAGE_INDEX, 'Catalogue de %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail d\'une %entity_label_singular%')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('color')
            ->add('description')
            ->add(BooleanFilter::new('image'))
            ->add('label')
            ->add('stone')
            ->add('size')
            ->add('tags')
            ->add('type')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield FormField::addPanel('Attributs');
                yield TextField::new('label', 'Libellé');
                yield TextField::new('stone', 'Pierre');
                yield TextEditorField::new('description', 'Description');
                yield TextField::new('type', 'Type');
                yield IntegerField::new('size', 'Taille');
                yield ColorField::new('color', 'Couleur');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return $value;
                    }
                );
                yield ArrayField::new('tags', 'Tags');

                yield FormField::addPanel('Stock');
                yield IntegerField::new('units', 'Stock');
                yield NumberField::new('threshold', 'Seuil d\'alerte');
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield FormField::addPanel('Attributs');
                yield IdField::new('id', "#")->hideOnForm();
                yield TextField::new('label', 'Libellé');
                yield AssociationField::new('stone', 'Pierre')->setCrudController(StoneCrudController::class);
                yield TextEditorField::new('description', 'Description');
                yield TextField::new('type', 'Type');
                yield IntegerField::new('size', 'Taille');
                yield ColorField::new('color', 'Couleur');
                yield UrlField::new('image', 'Url de l\'image');
                yield AssociationField::new('tags', 'Tags')->setCrudController(TagCrudController::class);

                yield FormField::addPanel('Stock');
                yield IntegerField::new('units', 'Stock');
                yield NumberField::new('threshold', 'Seuil d\'alerte');
                break;
            case Crud::PAGE_INDEX:
                yield TextField::new('label', 'Libellé');
                yield AssociationField::new('stone', 'Pierre');
                yield IntegerField::new('size', 'Taille');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return $value;
                    }
                );
                yield ColorField::new('color', 'Couleur');
                yield TextField::new('type', 'Type');
                yield IntegerField::new('units', 'Stock');
                yield NumberField::new('threshold', 'Seuil d\'alerte');
                yield MoneyField::new('price', 'Prix moyen')->setCurrency('EUR')->setStoredAsCents(false);
                break;
        }
    }
}
