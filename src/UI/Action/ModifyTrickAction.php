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
     * @param ModifyTrickResponder $responder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ModifyTrickResponderInterface $responder, Request $request)
    {

        if (!$trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'))){

            throw new \InvalidArgumentException(sprintf("")) ;

        }

        //recup objt et hydrate DTO

        //repository sur slug

        $slug = $request->get('slug');
        dump($slug);


        $trick = $this->trickRepository->getTrickBySlug($slug);
        dump($trick);
        //$authorizationChecker = new AuthorizationChecker();
        //die;
        /*if (!$this->security->isGranted('ROLE_USER',  $trick)) {
            dump('Pas d\'authorisation Messir de la fraude !!');
            //redirection
        }*/
            //die;

        $modifTrickDTO = $this->modifyTrickDTOFactory->createFromUI($trick);

        dump($modifTrickDTO);

        //die;

        //passe les donnéees DTO au Form via create ModifyTrickType::class, "datas"

        $modifyTrickType = $this->formFactory->create(ModifyTrickType::class, $modifTrickDTO)->handleRequest($request);

        dump($modifyTrickType->getData());
        //die;
        if ($this->modifyTrickTypeHandler->handle($modifyTrickType, $request)) {
            return $responder(true);
        } else {
            return $responder(false, $modifyTrickType);
        }
    }
}
