<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType ;
use Symfony\Component\Form\Extension\Core\Type\DateType ;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entity = $builder->getData();

        $builder
            ->add('name')
            ->add('surname')
            ->add('documentType', ChoiceType::class, [
                'choices'  => [
                    'DNI' =>'DNI',
                    'LC' => 'LC',
                    'LE' => 'LE',
                    'Pasaporte' => 'Pasaporte',
                    'CI' => 'CI',
                ],
                'data' => $entity->getDocumentType(),
            ])
            ->add('documentNumber')
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('mail', EmailType::class)
            ->add('experience', TextareaType::class, ['attr' => ['rows' => 7]])
            ->add('career')
            ->add('yearCareer', IntegerType::class, ['attr' => ['step' => 1]]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
