<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:08
 */

namespace App\UI\Form\Type\Interfaces;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ModifyTrickTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options);

    public function configureOptions(OptionsResolver $resolver);
}
