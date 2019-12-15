<?php

namespace AppBundle\Form;

use AppBundle\Entity\Persoon;
use AppBundle\Entity\Rsvp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RsvpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aantalPersonen', IntegerType::class)
            ->add('emailadres', EmailType::class)
            ->add('vragen', TextareaType::class)
            ->add('personen', CollectionType::class, [
                'entry_type' => PersoonType::class,
                'allow_add' => true,
                'label' => false,
                'allow_delete' => true,
//                'delete_empty' => function (Persoon $persoon = null) {
//                    return $persoon->getNaam() === null;
//                },
            ])
        ;

        $this->knoppenToevoegen($builder);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rsvp::class,
            'validation_groups' => [
                'aanmaken'
            ]
        ]);
    }

    private function knoppenToevoegen(FormBuilderInterface $builder)
    {
        $builder
            ->add('opslaan', SubmitType::class)
        ;
    }
}