<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 25/04/2018
 * Time: 13:44
 */

namespace App\UI\Form\Type;

use App\Domain\Video;
use App\UI\Form\Type\Interfaces\VideoTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('link', TextType::class,
            [
                'video_url' => 'link',
                'video_id' => 'vidId',
                'video_type' => 'vidType'

            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
            /*'empty_data' => function (FormInterface $Form) {
                    return new Image(
                        $Form->get('file')->getData()
                    );
                }*/
        ]);
    }
}
