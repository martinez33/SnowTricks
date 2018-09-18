<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 15/09/2018
 * Time: 07:32
 */

namespace App\UI\Form\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class VideoTypeExtension extends AbstractTypeExtension
{
    /**
     * @return string
     */
    public function getExtendedType()
    {
        return TextType::class;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(
            [
                'video_url',
                'video_id',
                'video_type'
            ]
        );
    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)//essayer sur ModifytrickType
    {

        if (isset($options['video_url'])) {
            $parentData = $form->getParent()->getData();

            dump($parentData);
            //die;

            $videoId = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $videoId = $accessor->getValue($parentData, $options['video_id']);
            }
            $view->vars['video_id'] = $videoId;

            $videoType = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $videoType = $accessor->getValue($parentData, $options['video_type']);
            }
            $view->vars['video_type'] = strtolower($videoType);
        }
    }
}