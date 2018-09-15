<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 14/08/2018
 * Time: 10:48
 */

namespace App\Domain\Factory;


use App\Domain\DTO\ModifTrickDTO;
use App\Domain\Trick;
use Symfony\Component\HttpFoundation\File\File;

class ModifyTrickDTOFactory
{

    /**
     * @var string
     */
    private $publicDirectory;

    /**
     * ModifyTrickDTOFactory constructor.
     * @param string $publicDirectory
     */
    public function __construct(string $publicDirectory)
    {
        $this->publicDirectory = $publicDirectory;
    }

    public function createFromUI(Trick $trick)
     {
         $this->transformImgToFile($trick->getImage()->toArray());
         $this->transformVideoToLink($trick->getVideo()->toArray());

         return new ModifTrickDTO($trick->getName(),
             $trick->getDescription(),
             $trick->getGrp(),
             $trick->getImage()->toArray(),
             $trick->getVideo()->toArray());
     }

     private function transformImgToFile(array $images)
     {
         foreach ($images as $image) {
             $image->setFile( new File($this->publicDirectory.$image->getFilename()));
         }
     }

     private  function transformVideoToLink(array $videos)
     {

         foreach ($videos as $video) {
             $vidType = strtolower($video->getVidType());

             $vidId = $video->getVidId();
             $video->setLink('<embed width="200" height="150" src="https://www.'
                 .$vidType.'.com/embed/'
                 .$vidId.'" frameborder="0" allow="encrypted-media" allowfullscreen />');
         }
     }

}