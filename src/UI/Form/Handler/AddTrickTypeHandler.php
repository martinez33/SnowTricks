<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:16
 */

namespace App\UI\Form\Handler;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var FindUrlInterface
     */
    private $findUrl;

    /**
     * @var ImageBuilderInterface
     */
    private $imageBuilder;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var SessionInterface
     */
    private $session;

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
     * @var UniqueTrickNameInterface
     */
    private $uniqueTrickName;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var VideoBuilderInterface
     */
    private $videoBuilder;

    /**
     * AddTrickTypeHandler constructor.
     *
     * @param FileUpLoader $fileUpLoader
     * @param FindUrlInterface $findUrl
     * @param ImageBuilderInterface $imageBuilder
     * @param string $imageUploadFolder
     * @param SessionInterface $session
     * @param SlugInterface $slug
     * @param TrickBuilderInterface $trickBuilder
     * @param TrickRepositoryInterface $trickRepository
     * @param UniqueTrickNameInterface $uniqueTrickName
     * @param VideoBuilderInterface $videoBuilder
     */
    public function __construct(
        FileUpLoader $fileUpLoader,
        FindUrlInterface $findUrl,
        ImageBuilderInterface $imageBuilder,
        string $imageUploadFolder,
        SessionInterface $session,
        SlugInterface $slug,
        TrickBuilderInterface $trickBuilder,
        TrickRepositoryInterface $trickRepository,
        UniqueTrickNameInterface $uniqueTrickName,
        ValidatorInterface $validator,
        VideoBuilderInterface $videoBuilder
    ) {
        $this->fileUpLoader = $fileUpLoader;
        $this->findUrl = $findUrl;
        $this->imageBuilder = $imageBuilder;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->session = $session;
        $this->slug = $slug;
        $this->trickBuilder = $trickBuilder;
        $this->trickRepository = $trickRepository;
        $this->uniqueTrickName = $uniqueTrickName;
        $this->validator = $validator;
        $this->videoBuilder = $videoBuilder;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form, Request $request): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {

            $errors = $this->validator->validate($form->getData(), null, array('creation'));

            if(count($errors) > 0) {
                $max = count($errors);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                }

                return false;
            }

            $name = $this->slug->slug($form->getData()->name);

            $this->trickBuilder->create(
                $form->getData()->name,
                $form->getData()->description,
                $form->getData()->grp,
                $name
            );


            $errorName = $this->validator->validate($this->trickBuilder->getTrick(), null, array('creation'));
            if(count($errorName) > 0) {
                $max = count($errorName);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errorName[$i]->getMessage());
                }

                return false;
            }

               //dump($errorName);
                //die();

                $this->trickRepository->save($this->trickBuilder->getTrick());

                $file = $form->getData()->image; //renvoie du tab image

                $maxImg = count($file);

                for ($i = 0; $i < $maxImg; $i++) {
                    $pict = $form->getData()->image[$i];

                    $fileName = $this->fileUpLoader->upLoadImg($pict['image']);

                   // dump($fileName);

                    if ($i == 0) {
                        $first = true;
                    } else {
                        $first = false;
                    }

                    $this->imageBuilder->create(
                        $request
                        ->files
                        ->get('add_trick')['image'][$i]['image']
                        ->getClientOriginalExtension(),
                        $this->imageUploadFolder . $fileName,
                        $first,
                        $this->trickBuilder->getTrick()
                    );

                    $this->trickRepository->save($this->imageBuilder->getImage());
                }

                $video = $form->getData()->video;
                $maxVideo = count($video);

                for ($i = 0; $i < $maxVideo; $i++) {
                    $str = $form->getData()->video[$i]['video'];

                    $vidType = $this->findUrl->SearchVideoType($str);
                    $vidId = $this->findUrl->FindVideoId($str, $vidType);

                    $this->videoBuilder->create(
                        $vidId,
                        $vidType,
                        $this->trickBuilder->getTrick()
                    );

                    $this->trickRepository->save($this->videoBuilder->getVideo());
                }
                return true;
        }
        return false;
    }
}
