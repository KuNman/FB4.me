<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BikeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', EntityType::class, array(
                'class' => 'AppBundle\Entity\Brand',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.brand');
                },
                'choice_label' => 'brand',
                'choice_value' => 'brand',
                ))
            ->add('model')
            ->add('material')
            ->add('fork')
            ->add('damper')
            ->add('wheels')
            ->add('size')
            ->add('geometry')
            ->add('gears')
            ->add('travelFork')
            ->add('travelDamper')
            ->add('weight')
            ->add('derailleur');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bike'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_bike';
    }


}
