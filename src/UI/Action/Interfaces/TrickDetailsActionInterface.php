<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 15:18
 */

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\TrickDetailsResponderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface TrickDetailsActionInterface
 *
 * @package App\UI\Action\Interfaces
 */
interface TrickDetailsActionInterface
{
    /**
     * TrickDetailsActionInterface constructor.
     *
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(
        TrickRepositoryInterface $trickRepository
    );

    /**
     * @param TrickDetailsResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(TrickDetailsResponderInterface $responder, Request $request);
}
