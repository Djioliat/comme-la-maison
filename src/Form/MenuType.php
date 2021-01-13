<?php

namespace App\Form;

use App\Entity\Food;
use App\Entity\Menu;
use App\Entity\Wine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('priceRestaurant',NumberType::class)
            ->add('priceTakeway', NumberType::class)
            ->add('foods', EntityType::class, array(
                "class" => Food::class,
                'choice_label' => 'name',
                'multiple' => true
            ))
            ->add('whineId', EntityType::class, array(
                "class" => Wine::class,
                'choice_label' => 'nameCuvee',
                'multiple' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
