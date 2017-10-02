<?php

namespace ViewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatDiversType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, array(
                'label' => 'Pseudo',
                'attr'=> ['placeholder'=>'Votre Pseudo']
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Message',
                'attr'=> ['placeholder'=>'Votre Message']
            ))
            ->add('createdAt',DateType::class)
            ->add('Envoyer', SubmitType::class)
            ->add('Modifier', ResetType::class )

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ViewBundle\Entity\ChatDivers'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'viewbundle_chatdivers';
    }


}
