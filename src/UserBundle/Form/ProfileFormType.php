<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 06/06/2019
 * Time: 02:01
 */

namespace UserBundle\Form;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('current_password');
    }

    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('Birthday', DateType::class, array(
                'label' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('Address')
            ->add('country')
            ->add('username')
            ->add('email')
            ->add('imagesId', FileType::class, array(
                'label' => false,
                'data_class' => null
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
