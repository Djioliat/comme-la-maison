<?php

namespace App\Form;

use App\Entity\Wine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCuvee')
            ->add('domaineName')
            ->add('year')
            ->add('pictureUrl')
            ->add('bio')
            ->add('bioDynamic')
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
