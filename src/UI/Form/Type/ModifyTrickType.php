<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:12
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;
use App\Domain\DTO\NewTrickDTO;
use App\UI\Form\Type\Interfaces\ModifyTrickTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifyTrickType extends AbstractType implements ModifyTrickTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'data' => 'name'
            ))
            ->add('description', TextareaType::class)
            ->add('grp', ChoiceType::class, array(
                'choices' => array(
                    'Rotations' => 'Rotation',
                    'Grab' => 'Grabs',
                    'Slides' => 'Slides'
                ),
            ))
            ->add('image', CollectionType::class, array(
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('video', CollectionType::class, array(
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true
            ));
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
