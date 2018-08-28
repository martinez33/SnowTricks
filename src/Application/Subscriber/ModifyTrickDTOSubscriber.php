<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 03/07/2018
 * Time: 12:50
 */

namespace App\Application\Subscriber;


use App\UI\Form\Extension\ImageTypeExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

class ModifyTrickDTOSubscriber implements EventSubscriberInterface
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
     * ModifyTrickDTOSubscriber constructor.
     * @param string $targetImgDirectory
     * @param ImageTypeExtension $imageEtxention
     */
    public function __construct(string $targetImgDirectory, ImageTypeExtension $imageEtxention)
    {
        $this->targetImgDirectory = $targetImgDirectory;
        $this->imageEtxention = $imageEtxention;
    }


    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPreSubmit',
            FormEvents::PRE_SET_DATA => 'test',
        ];
    }

    /**
     * @param FormEvent $formEvent
     */
    public function onPreSubmit(FormEvent $event)
    {
        //dump($event);

        //die;

        //foreach ($event->getForm()['image']->getData() as $key => $img) {


//$img->setFile();
//$img = $img[$key];
           // dump($img);
           //$res[$key]['file'] = $img->getFilename();

           //dump($res);
            /*$file = $imgDTO->getFile();

            $filename = $this->fileUploader->upLoadImg($file);

            //dump($file);
            //dump($filename);

            $imgDTO->setFilename($filename);
            $imgDTO->setExt($file->getClientOriginalExtension());
            $imgDTO->setFileName($this->imageUploadFolder.$filename);
            $imgDTO->setStorageId($filename);
            $key === 0 ? $imgDTO->setFirst(true) : $imgDTO->setFirst(false);

            //dump($imgDTO);

            $image = new Image($imgDTO);

            //dump(($image));
            $tabImg[] = $image;
            //die;*/

        //}

        //$event->getForm()['image']->setData($res);

        //dump($event);
        //die;

        /*foreach ($event->getData()->getImage() as $image ) {

            $file = new File($this->targetImgDirectory."/".$image->getStorageId());
            $image->setFile($file);

        }
        dump($event->getData());*/
//die;

        //$event->getForm()['image']->setData($images);

        //dump($event->getData()->getImage());
       //dump($event->getForm()['image']->setData($images));
        //dump($event->getForm()['image']->getData());
//die;
/*
        if ($event->getForm()['image']->getData()) {

            foreach ($event->getForm()['image']->getData() as $image) {

                dump($this->targetImgDirectory);

                if (null === $image->getFile() && null !== $image->getStorageId()) {
                    $file['file'] = new File($this->targetImgDirectory . $image->getStorageId());

                    $images[] = $file;
                }
            }


            dump($images);
            //dump(array_keys($event->getData()->toArray()) );
            $res = $event->getData();

            dump(array_key_exists('file', $images));
            //$event->getForm()['image']->setData($images);

//die;
            if (!isset($images)) {
                return;
            }
            $trick = $event->getData();
            //dump(isset($images) ,array_key_exists('image', $event->getForm()->get) , $event->getData());

            /* if (isset($images) && array_key_exists('image', $event->get)) {
                 dump('ok');
                 //die;
                 $pictureMerge = array_merge($event->getData()['picture'], $event->getData());
                 foreach ($pictureMerge as $key) {
                     if (null === $key['file']) {
                         unset($key);
                     } elseif (null !== $key['file']) {
                         $imageRest[] = $key;
                         $event->getData()['picture'] = $imageRest;
                     }
                 }
                 dump($event->getForm()['image']);
                 //die;
                 $formEvent->setData($trick);
             }
             if (isset($images) && !array_key_exists('image', $event->getData())) {
                 dump($event->getForm()['image']->getData());
                 dump($trick['image']);
 //                $trick['picture'] = $pictures;
   //              $formEvent->setData($trick);
             }
            // die;
         }*/

    }

    public function test(FormEvent $event)
    {
       /* dump($event->getData()->getImage()->toArray());
        dump($event->getForm()['image']->getData());

        die;*/
    }
}