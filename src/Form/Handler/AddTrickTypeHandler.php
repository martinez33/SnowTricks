<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:16
 */

namespace App\Form\Handler;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\SlugInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class AddTrickTypeHandler
 *
 * @package App\Form\Handler
 */
class AddTrickTypeHandler implements AddTrickTypeHandlerInterface
{
    /**
     * @var FileUpLoader
     */
    private $fileUpLoader;

    /**
     * @var ImageBuilderInterface
     */
    private $imageBuilder;

    private $imageFolder;

    /**
     * @var SessionInterface
     */
    private  $session;

    /**
     * @var SlugInterface
     */
    private $slug;

    /**
     * @var TrickBuilderInterface
     */
    private $trickBuilder;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;
    /**
     * @var VideoBuilderInterface
     */
    private $videoBuilder;

    /**
     * @var string
     */
    private $videoFolder;

    /**
     * AddTrickTypeHandler constructor.
     *
     * @param FileUpLoader              $fileUpLoader
     * @param ImageBuilderInterface     $imageBuilder
     * @param string                    $imageFolder
     * @param SessionInterface          $session
     * @param SlugInterface             $slug
     * @param TrickBuilderInterface     $trickBuilder
     * @param TrickRepositoryInterface  $trickRepository
     * @param VideoBuilderInterface     $videoBuilder
     * @param string                    $videoFolder
     */
    public function __construct(
        FileUpLoader $fileUpLoader,
        ImageBuilderInterface $imageBuilder,
        string $imageFolder,
        SessionInterface $session,
        SlugInterface $slug,
        TrickBuilderInterface $trickBuilder,
        TrickRepositoryInterface $trickRepository,
        VideoBuilderInterface $videoBuilder,
        string $videoFolder
    ) {
        $this->fileUpLoader = $fileUpLoader;
        $this->imageBuilder = $imageBuilder;
        $this->imageFolder = $imageFolder;
        $this->session = $session;
        $this->slug = $slug;
        $this->trickBuilder = $trickBuilder;
        $this->trickRepository = $trickRepository;
        $this->videoBuilder = $videoBuilder;
        $this->videoFolder = $videoFolder;
    }


    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form, Request $request): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dataName = $form->getData()->name;

            $data = $this->trickRepository->findNameExist($dataName); //voir plutot contrainte au niveau du Type


            if ($data != null) {
                $this->session
                    ->getFlashBag()
                    ->add(
                        'note',
                        'The Trick is already exist !'
                    )
                ;
            } else {
                $res = $this->slug->slug($form->getData()->name);

                $trickData = $this->trickBuilder->create(
                    $form->getData()->name,
                    $form->getData()->description,
                    $form->getData()->grp,
                    $res
                );

                $this->trickRepository->save($this->trickBuilder->getTrick());

                $file = $form->getData()->image; //renvoie du tab image

                $maxImg = count($file);

                for ($i = 0; $i < $maxImg; $i++) {
                    $this->fileUpLoader->upLoadImg($file[$i]);

                    $imageData = $this->imageBuilder->create(
                        $this->imageFolder .
                        $request
                            ->files
                            ->get('add_trick')['image'][$i]
                            ->getClientOriginalName(),
                        $request
                            ->files
                            ->get('add_trick')['image'][$i]
                            ->getClientOriginalExtension(),
                        $this->trickBuilder->getTrick()
                    );

                    $this->trickRepository->save($this->imageBuilder->getImage());
                }

                $video = $form->getData()->video;

                $maxVideo = count($video);

                for ($i = 0; $i < $maxVideo; $i++) {
                    $fileName = $this->fileUpLoader->upLoadVideo($video[$i]);

                    $videoData = $this->videoBuilder->create(
                        $this->videoFolder .
                        $fileName,
                        $this->trickBuilder->getTrick()
                    );

                    $this->trickRepository->save($this->videoBuilder->getVideo());
                }

                return true;
            }
        }
        return false;
    }
}
