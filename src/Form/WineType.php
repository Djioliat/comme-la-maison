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
    /**
     * Permet d'avoir la configuration d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder) {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
                ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCuvee', TextType::class, $this->getConfiguration("Nom", "Nom du vin"))
            ->add('domaineName', TextType::class, $this->getConfiguration("Domaine", "Nom du domaine"))
            ->add('year')
            ->add('description', TextType::class, $this->getConfiguration("Description", "Description du vin"))
            ->add('priceRestaurant', MoneyType::class, $this->getConfiguration("Prix du vin sur place", "Entrez le prix du vin"))
            ->add('priceTakeway', MoneyType::class, $this->getConfiguration("Prix du vin en livraison", "Entrez le prix du vin"))
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
            ->add('imageDescription',TextType::class, $this->getConfiguration("Description image", "Description du l'image (automatique)"))
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
