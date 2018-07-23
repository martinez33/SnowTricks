<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/07/2018
 * Time: 15:03
 */

namespace App\UI\Form\Handler;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginTypeHandler
{
    /**
     * @param FormInterface $form
     * @param Request $request
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function handle(FormInterface $form, Request $request)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            dump($request);
            dump($form->getData());
            //die;

            /* $event = new UserRegistrationEvent($user);
             dump($event);
             $this->eventDispatcher->dispatch(UserRegistrationEvent::NAME, $event);

             /*$errors = $this->validator->validate($form->getData(), null, array('creation'));

             if(count($errors) > 0) {
                 $max = count($errors);

                 for ($i=0; $i<$max; $i++) {

                     $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                 }

                 return false;
             }*/

            /*$user = $form->getData(); //hydratation du trick avec les données du DTO
            dump($user);
            $this->userRepository->save($user);*/


            return true;
        }
        return false;
    }
}