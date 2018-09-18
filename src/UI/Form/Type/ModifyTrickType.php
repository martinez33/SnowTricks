<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:12
 */

namespace App\UI\Form\Type;

use App\Application\Subscriber\ModifyTrickDTOSubscriber;
use App\Domain\DTO\ModifTrickDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifyTrickType extends AbstractType
{

    /**
     * @var ModifyTrickDTOSubscriber
     */
    private $modifyTrickDTOSubscriber;

    /**
     * ModifyTrickType constructor.
     * @param $modifyTrickDTOSubscriber
     */
    public function __construct(ModifyTrickDTOSubscriber $modifyTrickDTOSubscriber)
    {
        $this->modifyTrickDTOSubscriber = $modifyTrickDTOSubscriber;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
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
                'allow_add' => false,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,

            ))
            ->add('video', CollectionType::class, array(
                'entry_type' => VideoType::class,
                'allow_add' => false,
                'allow_delete' => true,
                'by_reference' => true,
                'prototype' => true,

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModifTrickDTO::class,
        ]);
    }
}
