<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthday', BirthdayType::class, array(
                    'label'=> 'Date D\'anniversaire',
                    'placeholder' => array(
                        'day'=>'Jour','month'=>'Mois' ,'year'=>'Année'
                    ))
            )
            ->add('address',TextType::class, array(
                'label'=> 'Votre Adresse',
                'attr'=> ['placeholder'=>'Votre Adresse']
            ))
            ->add('city',TextType::class, array(
                'label'=> 'Ville',
                'attr'=> ['placeholder'=>'Votre Ville']
            ))
            ->add('contry',TextType::class, array(
                'label'=> 'Pays',
                'attr'=> ['placeholder'=>'Votre Pays']
            )) 
            ->add('phoneNumber',TextType::class, array(
                'label'=> 'Télephone',
                'attr'=> ['placeholder'=>'Votre telephone']
            ))
            ->add('zipCode',TextType::class, array(
                'label'=> 'Code Postal',
                'attr'=> ['placeholder'=>'Code Postal']
            ))
            ->add('attachment',FileType::class,array(
                'label' => 'Photo de profil',
                'required' => false,
            ))->getForm()
/*            ->add('user')*/
        ;
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Membre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_membre';
    }


}
