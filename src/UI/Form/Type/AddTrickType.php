<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:02
 */

namespace App\UI\Form\Type;

use App\Application\Subscriber\NewTrickDTOSubscriber;
use App\Domain\DTO\TrickDTO;
use App\UI\Form\Type\Interfaces\AddTrickTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class AddTrickType
 *
 * @package App\Form\Type
 */
class AddTrickType extends AbstractType implements AddTrickTypeInterface
{
    /**
     * @var NewTrickDTOSubscriber
     */
    private $newTrickDTOSubscriber;

    public function __construct(NewTrickDTOSubscriber $newTrickDTOSubscriber)
    {
        $this->newTrickDTOSubscriber = $newTrickDTOSubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true
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
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
            ))
            ->add('video', CollectionType::class, array(
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ));
        $builder->addEventSubscriber($this->newTrickDTOSubscriber);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => array('creationDTO'),
            'data_class' => TrickDTO::class,
            /*'empty_data' => /**
             * @param FormInterface $Form
             * @return TrickDTO
             */
               /* function (FormInterface $Form) {
                    return new TrickDTO(
                    $Form->get('name')->getData(),
                    $Form->get('description')->getData(),
                    $Form->get('grp')->getData(),
                    $Form->get('image')->getData(),
                    $Form->get('video')->getData()
                );
                }*/
        ]);
    }
}
