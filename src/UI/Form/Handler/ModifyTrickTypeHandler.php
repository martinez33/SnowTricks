<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:32
 */

namespace App\UI\Form\Handler;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModifyTrickTypeHandler implements ModifyTrickTypeHandlerInterface
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
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var VideoBuilderInterface
     */
    private $videoBuilder;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * ModifyTrickTypeHandler constructor.
     * @param FileUpLoader $fileUpLoader
     * @param FindUrlInterface $findUrl
     * @param string $imageUploadFolder
     * @param SessionInterface $session
     * @param TrickRepositoryInterface $trickRepository
     * @param ValidatorInterface $validator
     * @param VideoBuilderInterface $videoBuilder
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(

        FileUpLoader $fileUpLoader,
        FindUrlInterface $findUrl,
        string $imageUploadFolder,
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        ValidatorInterface $validator,
        VideoBuilderInterface $videoBuilder,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->fileUpLoader = $fileUpLoader;
        $this->findUrl = $findUrl;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->validator = $validator;
        $this->videoBuilder = $videoBuilder;
        $this->imageRepository = $imageRepository;
    }


    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form, Request $request): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->getData()->getImage());

            $slug = $request->get('slug');

            $trick = $this->trickRepository->getTrickBySlug($slug);

            dump($trick);
            //dump($form['image']->getData());
            die;

            foreach ($form['image']->getData() as $key => $img) {

                $file = $img->getFile();
                dump($file);



                $filename = $this->fileUpLoader->upLoadImg($file);
                dump($filename);
                    //die;
                $img->setFilename($filename);
                $img->setExt($file->getClientOriginalExtension());
                $img->setFileName($this->imageUploadFolder.$filename);
                $img->setStorageId($filename);
                $key === 0 ? $img->setFirst(true) : $img->setFirst(false);
                //$trick->addImage($img);
            }

            $errors = $this->validator->validate($form->getData(), null, array('creation'));

            if(count($errors) > 0) {
                $max = count($errors);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                }

                return false;
            }

            $this->trickRepository->update();

            dump($trick);
            //die;

            return true;

            /*
                        $images = $form->getData()['image'];


                        foreach ($images as $cle => $tab) {

                            $fileName = $this->fileUpLoader->upLoadImg($tab['image']);


                            $res = $request->files->get('modify_trick')['image'];

                            foreach ($res as $ext) {

                                $images = new Image($ext['image']->getClientOriginalExtension(),
                                    $this->imageUploadFolder . $fileName);
                            }

                            $images->setTrick($trick);

                            $tabImg[] = $images;
                        }

                        $videos = $form->getData()['video'];

                        foreach ($videos as $video) {

                            dump($video['video']);
                            $str = $video['video'];

                            $vidType = $this->findUrl->SearchVideoType($str);
                            $vidId = $this->findUrl->FindVideoId($str, $vidType);

                            $videos = new Video($vidId, $vidType);

                            $videos->setTrick($trick);

                            $tabVid[] = $videos;
                            dump($tabVid);
                        }

                        $trick->update($form->getData()['description'], $form->getData()['grp'], $tabImg, $tabVid);

                        $this->trickRepository->update();
                        //$this->trickRepository->save($trick);

                        return true;*/
        }

        return false;
    }
}
