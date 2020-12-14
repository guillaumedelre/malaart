<?php

namespace App\Form;

use App\Entity\Component;
use App\Entity\Material;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dd($options);
        $builder
            ->add('units', IntegerType::class, ['label' => 'Unité(s)'])->setRequired(true)
            ->add('material', EntityType::class, ['class' => Material::class, 'label' => 'Fourniture'])->setRequired(true)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Component::class,
            ]
        );
    }

}
