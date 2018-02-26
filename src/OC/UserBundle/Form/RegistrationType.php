<?php


namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
          $builder
        ->add('newsletter', CheckboxType::class, array(
          'label' => 'S\'incrire à la Newsletter',
          'label_attr' => array('id' => 'newsletter'),
          'attr' => array('value' => 'true'),
          'required' => false,
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
