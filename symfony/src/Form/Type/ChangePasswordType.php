<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class, [
            'mapped' => false,
            'required' => true,
            'label' => 'Current Password',
            'constraints' => [
                new UserPassword(),
            ],
            'attr' => [
                'class' => 'input',
            ],
        ]);

        $builder->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'mapped' => false,
            'first_options'  => [
                'label' => 'Password',
                'required' => true,
                'attr' => [
                    'class' => 'input',
                ],
            ],
            'second_options' => [
                'label' => 'Repeat Password',
                'required' => true,
                'attr' => [
                    'class' => 'input',
                ],
            ],
            'invalid_message' => 'The password fields must match.',
        ]);

        $builder->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'button is-success',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
