<?php

namespace App\Controller\Admin;

use App\Admin\Field\ImageLocalField;
use App\Entity\Jewel;
use App\Form\ComponentFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class JewelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jewel::class;
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
            ->setEntityLabelInPlural('bijoux')
            ->setEntityLabelInSingular('bijou')
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
            ->add('description')
            ->add(BooleanFilter::new('image'))
            ->add('components')
            ->add('tags')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield FormField::addPanel('Attributs');
                yield TextField::new('name', 'Libellé');
                yield TextEditorField::new('description', 'Description');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return "https://localhost/uploads/$value";
                    }
                );
                yield ArrayField::new('tags', 'Tags');

                yield FormField::addPanel('Composition');
                yield ArrayField::new('components', 'Fournitures')->setFormType(ComponentFormType::class)->setTemplatePath('crud/field/table.html.twig');
                yield MoneyField::new('price', 'Prix estimé')->setCurrency('EUR')->setStoredAsCents(false);
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield FormField::addPanel('Attributs');
                yield IdField::new('id', "#")->hideOnForm();
                yield TextField::new('name', 'Libellé');
                yield TextEditorField::new('description', 'Description');
                yield ImageField::new('image', 'Image')->setTemplatePath('admin/crud/field/image_local')->setUploadDir('public/uploads');
                yield AssociationField::new('tags', 'Tags')->setCrudController(TagCrudController::class);

                yield FormField::addPanel('Composition');
                yield CollectionField::new('components', 'Fournitures')->setEntryType(ComponentFormType::class);
                break;
            case Crud::PAGE_INDEX:
                yield TextField::new('name', 'Libellé');
                yield ImageField::new('image', 'Image')->formatValue(
                    function ($value) {
                        if (empty($value)) {
                            return "https://via.placeholder.com/80x80.png?text=?";
                        }

                        return "https://localhost/uploads/$value";
                    }
                );
                yield AssociationField::new('components', 'Fournitures')->setCrudController(ComponentCrudController::class);
                yield MoneyField::new('price', 'Prix estimé')->setCurrency('EUR')->setStoredAsCents(false);
                break;
        }
    }
}
