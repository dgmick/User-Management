<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 06/06/2019
 * Time: 01:41
 */

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserUpdateType extends AbstractType
{
    /** @var AuthorizationCheckerInterface */
    protected $authorizationChecker;

    /** @var array  */
    protected $roles = [
        'ROLE_ADMIN' =>       'ROLE_USER',
        'ROLE_SUPER_ADMIN' => 'ROLE_ADMIN'
    ];

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => false,
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('lastName', TextType::class, array(
                'label' => false,
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('phone', TextType::class, array(
                'label' => false,
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('Birthday', DateType::class, array(
                'label' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('Address', TextType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Votre Adresse',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('country', null, array(
                'label' => false,
                'multiple' => false,
                'required' => true,
                'attr' => ['class' => 'select2 form-control input-lg']
            ))
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('imagesId', FileType::class, array(
                'label' => false,
                'data_class' => null
            ))
        ;
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $builder->add('roles', ChoiceType::class, array(
                'expanded'  => true,
                'multiple'  => true,
                'label' => false,
                'choices' => $this->roles
            ))
                ->add('enabled')
            ;
        }
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
