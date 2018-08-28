<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/04/2018
 * Time: 16:09
 */

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddTrickActionInterface;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use App\UI\Form\Type\AddTrickType;
use App\UI\Responder\Interfaces\AddTrickResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/tricks/creation",
 *     name="trick_creation")
 *
 * @Security("is_granted('ROLE_USER')")
 */
class AddTrickAction implements AddTrickActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddTrickTypeHandlerInterface
     */
    private $addTrickTypeHandler;

    /**
     * AddTrickAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param AddTrickTypeHandlerInterface $addTrickTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddTrickTypeHandlerInterface $addTrickTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->addTrickTypeHandler = $addTrickTypeHandler;
    }

    /**
     * @param AddTrickResponderInterface $responder
     * @param Request $request
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(
        AddTrickResponderInterface $responder,
        Request $request,
        SessionInterface $session
    ) {

        $addTrickType = $this->formFactory->create(AddTrickType::class)->handleRequest($request);

        if ($this->addTrickTypeHandler->handle($addTrickType, $request)) {
            $session->getFlashBag()->add('notice', 'Successfull : Trick created !'); //mettre plutot au niveau du handler

            return $responder(true);
        } else {
            return $responder(false, $addTrickType);
        }
    }
}
