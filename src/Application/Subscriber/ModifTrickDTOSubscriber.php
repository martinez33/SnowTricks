<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 03/07/2018
 * Time: 12:50
 */

namespace App\Application\Subscriber;


use App\Helper\Interfaces\FindUrlInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ModifTrickDTOSubscriber implements EventSubscriberInterface
{
    /**
     * @var FindUrlInterface
     */
    private $findUrl;

    /**
     * ModifTrickDTOSubscriber constructor.
     * @param FindUrlInterface $findUrl
     */
    public function __construct(FindUrlInterface $findUrl)
    {
        $this->findUrl = $findUrl;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     * @throws \Exception
     */
    public function onPreSubmit(FormEvent $event)
    {
        $trickImages = $event->getForm()['image']->getData();
        $tabData = $event->getData();

        if (array_key_exists('image', $tabData)) {    //Si LES images ne sont pas vide !

            $newTrickImages = $event->getData()['image']; //newTrickImages recup les images

            $indexToRmv = array_keys(array_diff_key($trickImages, $newTrickImages)); //index different des nouvelles images

            $cloneImages = $trickImages; //clonage des images de base

            foreach ($indexToRmv as $i) {
                unset($cloneImages[$i]);  //Suppression de l'image ayant l'index different  == Probleme pour upload car les index sont les meme !
            }

            $imgAdded = array_diff_key($newTrickImages, $trickImages); //Image ajouté
            foreach ($imgAdded as $key => $id) {
                unset($newTrickImages[$key]);//On ne garde que les index identiques aux anciennes images
            }

            if (array_keys($newTrickImages) === array_keys($cloneImages)) {
                $oldImg = false;
                foreach ($newTrickImages as $cpt => $newImg) {

                    if($newImg['file'] === null) {
                        $tabRecupFile[$cpt]['file'] = $cloneImages[$cpt]->getFile();
                        $oldImg = true;
                    }
                }
                if ($oldImg) {
                    $tabModifImg = array_replace($newTrickImages, $tabRecupFile, $imgAdded);
                } else {
                    $tabModifImg = array_replace($newTrickImages, $imgAdded);
                }
            }
            $finalTabImg['image'] = $tabModifImg;
            $finalTab = array_replace($tabData, $finalTabImg);
        } else {

            $tabDefaultImg['image'][0]['file'] = $trickImages[0]->getFile();
            $finalTab = array_replace($tabData, $tabDefaultImg);
        }
        $event->setData($finalTab);
    }

}