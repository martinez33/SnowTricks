<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:16
 */

namespace App\UI\Form\Handler;


use App\Domain\Image;
use App\Domain\Trick;


use App\Helper\FileUpLoader;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use PhpParser\Node\Scalar\MagicConst\File;
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
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var FileUpLoader
     */
    private $fileUploader;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AddTrickTypeHandler constructor.
     * @param SessionInterface $session
     * @param TrickRepositoryInterface $trickRepository
     * @param FileUpLoader $fileUploader
     * @param string $imageUploadFolder
     * @param ValidatorInterface $validator
     */
    public function __construct(
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        FileUpLoader $fileUploader,
        string $imageUploadFolder,
        ValidatorInterface $validator
    ) {
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->fileUploader = $fileUploader;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->validator = $validator;
    }


    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form, Request $request): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {

            dump($form['image']->getData());
//die;
            /*foreach ($form['image']->getData() as $imgDTO) {
                dump($imgDTO->getFile());
                $res = $imgDTO->getFile();
                dump($res->getFilename());

            }*/
            //die;

            foreach ($form['image']->getData() as $key => $img) {

                $file = $img->getFile();

                $filename = $this->fileUploader->upLoadImg($file);

                //dump($file);
                //dump($filename);

                $img->setFilename($filename);
                $img->setExt($file->getClientOriginalExtension());
                $img->setFileName($this->imageUploadFolder.$filename);
                $img->setStorageId($filename);
                $key === 0 ? $img->setFirst(true) : $img->setFirst(false);
            }

            $errors = $this->validator->validate($form->getData(), null, array('creation'));

            if(count($errors) > 0) {
                $max = count($errors);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                }

                return false;
            }

            //$trick = new Trick($form->getData()); //hydratation du trick avec les données du DTO
dump($form->getData());
            $trick =  new Trick($form->getData());
            dump($trick);
            //die;
            $errorName = $this->validator->validate($trick, null, array('creation'));
            if(count($errorName) > 0) {
                $max = count($errorName);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errorName[$i]->getMessage());
                }

                return false;
            }

            $this->trickRepository->save($trick);

            return true;
        }
        return false;
    }
}
