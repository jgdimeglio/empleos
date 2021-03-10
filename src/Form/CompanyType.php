<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Province;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CompanyType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $entity = $builder->getData();

        $provincesChoices = [];
        $provinces = $this->entityManager->getRepository(Province::class)->findAll();
        foreach ($provinces as $province) {
            $provincesChoices[$province->getName()] = $province->getId();
        }

        $provinceId = null;
        if($entity->getProvince())
            $provinceId = $entity->getProvince()->getId();


        $locationsChoices = [];

        if($entity->getProvince())
            $locations = $entity->getProvince()->getLocations();
        else if(isset($provinces[0]))
            $locations = $provinces[0]->getLocations();
        else
            $locations = [];


        foreach ($locations as $location) {
            $locationsChoices[$location->getName()] = $location->getId();
        }

        $locationId = null;
        if($entity->getLocation())
            $locationId = $entity->getLocation()->getId();

        $builder
            ->add('name')
            ->add('cuit')
            ->add('address')
            ->add('phone')
            ->add('mail')
            ->add('province_in_form', ChoiceType::class, [
                'mapped' => false,
                'choices' => $provincesChoices,
                'data' => $provinceId,
            ])
            ->add('location_in_form', ChoiceType::class, [
                'mapped' => false,
                'choices' => $locationsChoices,
                'data' => $locationId,
            ]);

        $builder->get('location_in_form')->resetViewTransformers();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
