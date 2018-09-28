<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 24/04/2018
 * Time: 14:42
 */

namespace App\UI\Form\Type;

use App\Application\Subscriber\ModifTrickDTOSubscriber;
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
    /**
     * @var ModifTrickDTOSubscriber
     */
    private $modifyTrickDTOSubscriber;

    public function __construct(ModifTrickDTOSubscriber $modifyTrickDTOSubscriber)
    {
        $this->modifyTrickDTOSubscriber = $modifyTrickDTOSubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file',FileType::class,
                [
                    'image_property' => 'filename',
                    'image_id' => 'id',
                    'label' => 'Image',
                    'required' => false
                ]

            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            /*'empty_data' => function (FormInterface $Form) {
                    return new Image(
                        $Form->get('file')->getData()
                    );
                }*/
        ]);
    }
}
