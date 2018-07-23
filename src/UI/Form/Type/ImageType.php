<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 24/04/2018
 * Time: 14:42
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\ImageDTO;
use App\Domain\Image;
use App\UI\Form\Type\Interfaces\ImageTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            /*'empty_data' => function (FormInterface $form) {
                    return new Image(
                        $form->get('file')->getData()
                    );
                }*/
        ]);
    }
}
