<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 03/07/2018
 * Time: 12:35
 */

namespace App\UI\Form\Extension;


use App\UI\Form\Type\ImageType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ImageTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(array('image_property'));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)//essayer sur ModifytrickType
    {

        if (isset($options['image_property'])) {
            dump($form, $view);//specifier sur clé vars les files

            // this will be whatever class/entity is bound to your Form (e.g. Media)
            $parentData = $form->getParent()->getData();
            dump($parentData);
            //die;
            $imageUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['image_property']);
            }

            // sets an "image_url" variable that will be available when rendering this field
            $view->vars['image_url'] = $imageUrl;
            dump($imageUrl);
           // die;
        }
    }

    /*public function finishView(FormView $view, FormInterface $Form, array $options)
    {
        dump($Form, $view);
        die;
    }*/
}