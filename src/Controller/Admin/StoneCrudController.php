<?php

namespace App\Controller\Admin;

use App\Domain\Chakra;
use App\Domain\CrystalSystem;
use App\Entity\Stone;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class StoneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stone::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('pierres')
            ->setEntityLabelInSingular('pierre')
            ->setPageTitle(Crud::PAGE_INDEX, 'Catalogue de %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail d\'une %entity_label_singular%')
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(BooleanFilter::new('image'))
            ->add('label')
            ->add('chakra')
            ->add('nature')
            ->add('crystalSystem')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield FormField::addPanel('Attributs');
                yield TextField::new('label', 'Libellé');
                yield TextField::new('nature', 'Nature');
                yield TextField::new('chakra', 'Chakra');
                yield TextField::new('crystalSystem', 'Système cristallin');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return $value;
                    }
                );
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield FormField::addPanel('Attributs');
                yield IdField::new('id', "#")->hideOnForm();
                yield TextField::new('label', 'Libellé');
                yield TextField::new('nature', 'Nature');
                yield ChoiceField::new('chakra', 'Chakra')->setChoices(Chakra::FORM_CHOICES);
                yield ChoiceField::new('crystalSystem', 'Système cristallin')->setChoices(CrystalSystem::FORM_CHOICES);
                yield UrlField::new('image', 'Url de l\'image');
                break;
            case Crud::PAGE_INDEX:
                yield TextField::new('label', 'Libellé');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return $value;
                    }
                );
                yield TextField::new('chakra', 'Chakra');
                yield TextField::new('crystalSystem', 'Système cristallin');
                yield TextField::new('nature', 'Nature');
                break;
        }
    }
}
