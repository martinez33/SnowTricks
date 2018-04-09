<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 16:44
 */

namespace App\UI\Action;


use App\Domain\Interfaces\TrickInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\TrickDetailsActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use App\UI\Responder\Interfaces\TrickDetailsResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickDetailsAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/tricks/{name}"
 *     requirements={"name" = "\w+"}
 * )
 */
class TrickDetailsAction implements TrickDetailsActionInterface
{
    private $trickRepository;

    public function __construct(TrickRepositoryInterface $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param TrickDetailsResponderInterface $responder
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(TrickDetailsResponderInterface $responder)
    {
        $name = 'Test';

        $data = $this->trickRepository->findTrick($name);

        if (!empty($data)) {
            return $responder($data);
        } else {
            throw new \Exception('Invalid Datas !');
        }
    }
}