<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:02
 */

namespace App\Form\Type;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;
use App\Domain\DTO\NewTrickDTO;
use App\Form\Type\Interfaces\AddTrickTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddTrickType
 *
 * @package App\Form\Type
 */
class AddTrickType extends AbstractType implements AddTrickTypeInterface
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('grp', TextType::class)
            ->add('image', CollectionType::class, array(
                'entry_type' => FileType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('video', CollectionType::class, array(
                'entry_type' => FileType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => NewTrickDTOInterface::class,
            'empty_data' => /**
             * @param FormInterface $form
             * @return NewTrickDTO
             */
                function (FormInterface $form) {
                    return new NewTrickDTO(
                    $form->get('name')->getData(),
                    $form->get('description')->getData(),
                    $form->get('grp')->getData(),
                    $form->get('image')->getData(),
                    $form->get('video')->getData()
                );
                }
        ]);
    }
}
