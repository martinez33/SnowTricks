<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:16
 */

namespace App\UI\Form\Handler;


use App\Domain\Trick;


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
     * AddTrickTypeHandler constructor.
     *
     * @param SessionInterface $session
     * @param TrickRepositoryInterface $trickRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        ValidatorInterface $validator
    ) {
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->validator = $validator;
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

            $trick = new Trick($form->getData()); //hydratation du trick avec les données du DTO

            $errorName = $this->validator->validate($trick, null, array('creation'));
            if(count($errorName) > 0) {
                $max = count($errorName);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errorName[$i]->getMessage());
                }

                return false;
            }

           /* dump($form->getData());
            die();*/
            $this->trickRepository->save($trick);

            return true;
        }
        return false;
    }
}
