<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 17/04/2018
 * Time: 09:38
 */

namespace App\Form\Type\Interfaces;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface AddTrickTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options);

    public function configureOptions(OptionsResolver $resolver);
}
