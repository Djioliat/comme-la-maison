<?php

namespace App\Form;

use App\Entity\Wine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class WineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCuvee')
            ->add('domaineName')
            ->add('year')
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
            ->add('bio')
            ->add('description')
            ->add('priceRestaurant')
            ->add('priceTakeway')
            ->add('imageDescription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wine::class,
        ]);
    }
}
