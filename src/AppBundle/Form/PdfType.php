<?php

namespace AppBundle\Form;

use AppBundle\Entity\Persoon;
use AppBundle\Model\PdfModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PdfType extends AbstractType
{
    const CHOICES = [
        'Alles' => PdfModel::ALLES,
        'Personen' => PdfModel::PERSONEN,
        'Verzoeknummers' => PdfModel::NUMMERS,
        'Emailadressen' => PdfModel::EMAILADRESSEN,
        'Nummers' => PdfModel::NUMMERS
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('watTonen', ChoiceType::class, [
                'choices' => self::CHOICES,
                'multiple' => false,
            ])
        ;

        $this->knoppenToevoegen($builder);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PdfModel::class,
            'validation_groups' => ['aanmaken']
        ]);
    }

    private function knoppenToevoegen(FormBuilderInterface $builder)
    {
        $builder
            ->add('opslaan', SubmitType::class)
        ;
    }
}