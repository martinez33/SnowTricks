<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 03/07/2018
 * Time: 12:50
 */

namespace App\Application\Subscriber;


use App\Helper\FileUpLoader;
use App\UI\Form\Extension\ImageTypeExtension;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ModifTrickDTOSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $targetImgDirectory;

    /**
     * @var ImageTypeExtension
     */
    private $imageEtxention;

    /**
     * @var FileUpLoader
     */
    private $fileUpLoader;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * ModifyTrickDTOSubscriber constructor.
     * @param string $targetImgDirectory
     * @param ImageTypeExtension $imageEtxention
     * @param FileUpLoader $fileUpLoader
     * @param string $imageUploadFolder
     */
    public function __construct(
        string $targetImgDirectory,
        ImageTypeExtension $imageEtxention,
        FileUpLoader $fileUpLoader,
        string $imageUploadFolder
    ) {
        $this->targetImgDirectory = $targetImgDirectory;
        $this->imageEtxention = $imageEtxention;
        $this->fileUpLoader = $fileUpLoader;
        $this->imageUploadFolder = $imageUploadFolder;
    }


    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
            FormEvents::PRE_SET_DATA => 'test',
        ];
    }

    /**
     * @param FormEvent $formEvent
     */
    public function onPreSubmit(FormEvent $event)
    {
        $currentTrick = $event->getData();
        $form = $event->getForm();
        dump($event);
        //die;

        $assignImgTab = [];
        $imageRest = [];

        foreach ($currentTrick['image'] as $imgKey => $imagesForm) {

            if ($imagesForm['file'] === null) { //si il y a des images à conserver

                foreach ($form['image']->getData() as $cpt => $image) {

                    if ($imgKey === $cpt) { //attribution via clé de tableau de la bonne image

                        $assignImgTab[$cpt]['file'] = $image->getFile();//tableau anciennes images avec bonne clé tableau
                    }
                }
            } elseif ($imagesForm['file'] !== null) {//si il y a des nouvelle(s) image(s)

                $imageRest[] = $imagesForm; // tableau des nouvelles images

            } else {
                $imageRest = [];
            }

        }


        dump($assignImgTab);
        dump($imageRest);
        die;
        unset($currentTrick['image']);

        if (isset($imageRest) && isset($assignImgTab)) {
            $temp['image'] = array_merge($assignImgTab, $imageRest);

            $images = array_merge($currentTrick, $temp);
        } else {
            $assignImg['image'] = $assignImgTab;
            //dump($temp2);
            $images = array_merge($currentTrick, $assignImg);
        }


        $event->setData($images);







    }

    public function test(FormEvent $event)
    {
        /*$trick = $event->getData();
        $form = $event->getForm();
        dump($event);
        dump($trick);
        dump($form);
       //die;*/



        //die;

    }
}