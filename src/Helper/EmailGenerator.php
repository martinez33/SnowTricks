<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 26/07/2018
 * Time: 15:18
 */

namespace App\Helper;


use Twig\Environment;

class EmailGenerator
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * EmailGenerator constructor.
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }


    /**
     * @param string $name
     * @param string $email
     * @param string $cle
     * @return \Swift_Message
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function emailMaker(string $name, string $email, string $cle, string $emailToSend)
    {
        $message = (new \Swift_Message('New Account validation'))
            ->setFrom('martinforestier.contact@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->twig->render($emailToSend,
                    array(
                        'name' => $name,
                        'token' => $cle
                    )
                )
            );

        return $message;
    }

    /**
     * @param \Swift_Message $message
     */
    public function sendEmail(\Swift_Message $message)
    {
        $this->mailer->send($message);
    }
}