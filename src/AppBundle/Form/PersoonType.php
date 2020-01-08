<?php

namespace AppBundle\Form;

use AppBundle\Entity\Persoon;
use AppBundle\Entity\Verzoeknummer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersoonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', TextType::class)
            ->add('nummers', CollectionType::class, [
                'entry_type' => VerzoeknummerType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false,
                'delete_empty' => function (Verzoeknummer $nummer = null) {
                    return $nummer === null || $nummer->getNummer() === null;
                },

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Persoon::class,
            'label' => false
        ]);
    }
}