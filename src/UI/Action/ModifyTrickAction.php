<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:43
 */

namespace App\UI\Action;

use App\Domain\DTO\ModifTrickDTO;
use App\Domain\DTO\TrickDTO;
use App\Domain\Factory\ModifyTrickDTOFactory;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\ModifyTrickActionInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use App\UI\Form\Handler\ModifyTrickTypeHandler;
use App\UI\Form\Type\Interfaces\ModifyTrickTypeInterface;
use App\UI\Form\Type\ModifyTrickType;
use App\UI\Responder\Interfaces\ModifyTrickResponderInterface;
use App\UI\Responder\ModifyTrickResponder;
use Psr\Log\InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class ModifyTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/tricks/update/{slug}",
 *     name="trick_modify"
 * )
 *
 *
 */
class ModifyTrickAction implements ModifyTrickActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ModifyTrickTypeHandlerInterface
     */
    private $modifyTrickTypeHandler;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var \Symfony\Component\Security\Core\Security
     */
    private $security;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ModifyTrickDTOFactory
     */
    private $modifyTrickDTOFactory;

    /**
     * ModifyTrickAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler
     * @param TrickRepositoryInterface $trickRepository
     * @param \Symfony\Component\Security\Core\Security $security
     * @param SessionInterface $session
     * @param ModifyTrickDTOFactory $modifyTrickDTOFactory
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler,
        TrickRepositoryInterface $trickRepository,
        \Symfony\Component\Security\Core\Security $security,
        SessionInterface $session,
        ModifyTrickDTOFactory $modifyTrickDTOFactory
    ) {
        $this->formFactory = $formFactory;
        $this->modifyTrickTypeHandler = $modifyTrickTypeHandler;
        $this->trickRepository = $trickRepository;
        $this->security = $security;
        $this->session = $session;
        $this->modifyTrickDTOFactory = $modifyTrickDTOFactory;
    }


    /**
     * @param ModifyTrickResponderInterface $responder
     * @param Request $request
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(ModifyTrickResponderInterface $responder, Request $request, SessionInterface $session)
    {

        if (!$trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'))){

            throw new \InvalidArgumentException(sprintf("")) ;

        }

        $slug = $request->get('slug');

        $trick = $this->trickRepository->getTrickBySlug($slug);

        $modifTrickDTO = $this->modifyTrickDTOFactory->createFromUI($trick);

        $modifyTrickType = $this->formFactory->create(ModifyTrickType::class, $modifTrickDTO)->handleRequest($request);

        //dump($modifyTrickType->getData());
        //die;
        if ($this->modifyTrickTypeHandler->handle($modifyTrickType, $request, $trick)) {
            $session->getFlashBag()->add('notice', 'Successfull : Trick Modified !');
            return $responder(true);
        } else {
            return $responder(false, $modifyTrickType);
        }
    }
}
