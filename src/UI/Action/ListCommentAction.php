<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 13:38
 */

namespace App\UI\Action;


use App\Domain\Trick;
use App\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Action\Interfaces\ListCommentActionInterface;
use App\UI\Responder\Interfaces\ListCommentResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListCommentAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/comments/{_locale}"
 * )
 */
class ListCommentAction implements ListCommentActionInterface
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * ListCommentAction constructor.
     *
     * @param CommentRepositoryInterface  $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param ListCommentResponderInterface  $responder
     * @return array
     */
    public function __invoke(ListCommentResponderInterface $responder)
    {

        $data = $this->commentRepository->findAllComment();

        return $responder($data);
    }
}