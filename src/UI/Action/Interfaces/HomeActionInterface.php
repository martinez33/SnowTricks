<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:42.
 */

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Doctrine\ORM\EntityManagerInterface;

interface HomeActionInterface
{
    /**
     * HomeActionInterface constructor.
     *
     * @param string                   $imageFolder
     * @param TrickRepositoryInterface $trickRepository
     * @param array                    $datas
     */
    public function __construct(
        TrickRepositoryInterface $trickRepository
    );

    /**
     * @param HomeResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(HomeResponderInterface $responder);
}
