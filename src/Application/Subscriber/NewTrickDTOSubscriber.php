<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/05/2018
 * Time: 10:24
 */

namespace App\Application\Subscriber;


use App\Domain\Image;
use App\Domain\Video;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class NewTrickDTOSubscriber implements EventSubscriberInterface
{
    /**
     * @var SlugInterface
     */
    private $slug;
    /**
     * @var FileUpLoader
     */
    private $fileUploader;

    /**
     * @var FindUrlInterface
     */
    private $findUrl;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * NewTrickDTOSubscriber constructor.
     *
     * @param SlugInterface $slug
     * @param FileUpLoader $fileUploader
     */
    public function __construct(SlugInterface $slug, FileUpLoader $fileUploader, FindUrlInterface $findUrl, string $imageUploadFolder)
    {
        $this->slug = $slug;
        $this->fileUploader = $fileUploader;
        $this->findUrl = $findUrl;
        $this->imageUploadFolder = $imageUploadFolder;
    }


    public static function getSubscribedEvents()
    {
        return [
          FormEvents::SUBMIT => "onNewTrickDTOSubmission" //appel de la method lorsque le form est soumis
        ];
    }

    public function onNewTrickDTOSubmission(FormEvent $event)
    {
        $images = [];
        $event->getData()->slug = $this->slug->slug($event->getData()->name);

        foreach ($event->getData()->image as $key => $image) {

            $fileName = $this->fileUploader->upLoadImg($image);
            $images[] = new Image(
                $image->getClientOriginalExtension(),
                $this->imageUploadFolder.$fileName,
                $key === 0 ? true : false
            );
        }
        $event->getData()->image = $images;


        $videos = [];

        foreach ($event->getData()->video as $video) {


            $vidType = $this->findUrl->SearchVideoType($video);
            $vidId = $this->findUrl->FindVideoId($video, $vidType);

            $videos[] = new Video($vidId, $vidType);
        }
        $event->getData()->video = $videos;
    }
}