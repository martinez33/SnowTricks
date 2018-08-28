<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 16:23
 */

namespace App\UI\Form\Type;



use App\Domain\User;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Nom d\'utilisateur',
                'attr' => array(
                    'minLength' => 5,
                    'maxLength' => 30
                )
            ))
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class,
                array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Confirmez le mot de passe'),
                    'invalid_message' => 'Le mot de passe doit comporter au moins : un caractère minuscule, un caractère Majuscule et un chiffre !!',
                    'constraints' => array(new Assert\Regex(array('pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/',
                        'message' => 'Le mot de passe doit comporter au moins : un caractère minuscule, un caractère Majuscule et un 1 chiffre !!'))
                        //'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)/'
                )))
        ;
    }
}