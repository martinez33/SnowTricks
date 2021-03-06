<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/07/2018
 * Time: 14:57
 */

namespace App\UI\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'attr' => array(
                    'minLength' => 4,
                    'maxLength' => 30,
                )

            ))
            ->add('password', PasswordType::class);
    }
}