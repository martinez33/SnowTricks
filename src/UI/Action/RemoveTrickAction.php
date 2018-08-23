<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 09:40
 */

namespace App\UI\Action;

use App\Domain\Interfaces\TrickInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\RemoveTrickActionInterface;
use App\UI\Responder\Interfaces\RemoveTrickResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RemoveTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/delete/{slug}",
 *     name="trick_delete"
 *     )
 *
 * @Security("is_granted('ROLE_USER')")
 */
class RemoveTrickAction implements RemoveTrickActionInterface
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $publicDirectory;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * RemoveTrickAction constructor.
     *
     * @param Filesystem                $fileSystem
     * @param string                    $publicDirectory
     * @param TrickRepositoryInterface  $trickRepository
     * @param SessionInterface          $session
     */
    public function __construct(
        Filesystem $fileSystem,
        string $publicDirectory,
        TrickRepositoryInterface $trickRepository,
        SessionInterface $session
    ) {
        $this->fileSystem = $fileSystem;
        $this->publicDirectory = $publicDirectory;
        $this->trickRepository = $trickRepository;
        $this->session = $session;
    }


    /**
     * @param Request $request
     * @param RemoveTrickResponderInterface $responder
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(
        Request $request,
        RemoveTrickResponderInterface $responder
    ) {

        $trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'));

        foreach ($trick->getImage() as $fileNames) {

            $images[] = $this->publicDirectory.$fileNames->getFileName();
        }

        $this->fileSystem->remove($images);


        $result = $this->trickRepository->delTrickBySlug($trick);

        $result == null
            ? $this->session->getFlashBag()->add('notice', 'Successfull : Trick removed !')
            : $this->session->getFlashBag()->add('notice', 'Error : Remove Impossible !');

        return $responder();
    }
}
