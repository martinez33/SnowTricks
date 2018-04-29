<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 24/04/2018
 * Time: 14:36
 */

namespace App\UI\Form\Type\Interfaces;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ImageTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options);

    public function configureOptions(OptionsResolver $resolver);
}