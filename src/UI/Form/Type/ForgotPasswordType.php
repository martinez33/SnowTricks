<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/08/2018
 * Time: 15:23
 */

namespace App\UI\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ForgotPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
            'label' => 'Nom d\'utilisateur'
        ));
    }
}