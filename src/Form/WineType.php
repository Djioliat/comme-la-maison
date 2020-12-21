<?php

namespace App\Form;

use App\Entity\Wine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class WineType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCuvee', TextType::class)
            ->add('domaineName', TextType::class)
            ->add('year')
            ->add('description', TextType::class)
            ->add('priceRestaurant', MoneyType::class)
            ->add('priceTakeway', MoneyType::class)
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
            ->add('bio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wine::class,
        ]);
    }
}
