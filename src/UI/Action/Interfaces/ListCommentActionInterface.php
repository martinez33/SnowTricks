<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 13:37
 */

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Responder\Interfaces\ListCommentResponderInterface;

interface ListCommentActionInterface
{
    public function __construct(CommentRepositoryInterface $commentRepository);

    public function __invoke(ListCommentResponderInterface $responder);
}
