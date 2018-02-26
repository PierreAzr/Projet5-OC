<?php

namespace OC\NAOBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use OC\NAOBundle\Form\PictureType;


class ObservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('taxrefname', TextType::class)
        ->add('notsur', CheckboxType::class, array(
          "required" => false,
          "label" => false,
        ))
        ->add('picture', PictureType::class, array(
          "required" => false,
        ))
        ->add('dateObs', DateType::class, array(
          'label' => false,
          'widget' => 'single_text',
          'format' => 'dd/MM/yyyy',
        ))
        ->add('latitude', TextType::class, array(
          'attr' => array(
            'readonly' => true,
          )
        ))
        ->add('longitude', TextType::class, array(
          'attr' => array(
            'readonly' => true,
          )
        ))
        ->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\NAOBundle\Entity\Observation'
        ));
    }
}
