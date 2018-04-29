<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 27/04/2018
 * Time: 14:09
 */

namespace App\Helper;


use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;

class UniqueTrickName implements UniqueTrickNameInterface
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * UniqueTrickName constructor.
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(TrickRepositoryInterface $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }


    public function isUniqueName($name)
    {
        if ($this->trickRepository->findNameExist($name) == null) {
            return true;
        }
        return false;
    }
}