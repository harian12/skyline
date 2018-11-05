<?php

use phalcon\Http\Request;
//use form
use App\Forms\RegisterForm;

class SignupController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->form = new RegisterForm();
    }

    public function registerAction()
    {
        $request = new Request();
        $user = new Users();
        $form = new RegisterForm();
        $email = new Mail();

        // cek data tipe post
        if (!$this->request->isPost()){
            return $this->response->redirect('signup');
        }

        $form->bind($_POST, $user);

//        echo (new \Phalcon\Debug\Dump())->variables($deco);

        // cek validasi
        if(!$form->isValid()){
            $messages = $form->getMessages();

            foreach ($messages as $message){
                $this->flashSession->error($message);
                
                // return $this->dispatcher->forward(['controller' => 'signup', 'action' => 'index']);

                $this->dispatcher->forward(
                    [
                        'controller' => $this->router->getControllerName(),
                        'action' => 'index'
                    ]);
                    return;
            }
        }

        $user->setPassword($this->security->hash($_POST['password']));

        if(!$user->save()){
            foreach ($user->getMessages() as $m){
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action' => 'index'
                ]);
            }
            return;
        }

        $this->flashSession->success('Registrasi Berhasil');
        return $this->response->redirect('');

//
//        $name = $this->request->getPost('name', ['trim','string']);
//        $email = $this->request->getPost('email', ['trim','email']);
//
//        // ubah kebentuk array array
//        // print_r($this->request->getPost());
//        // exit();
//
//         $succes= $user->save(
//             [
//                 "name" => $name,
//                 "email" => $email
//             ],
//             [
//                "name",
//                "email",
//            ]
//             );
//
//        if($succes){
//            $this->flashSession->success("Thank for registering!");
//            return $this->response->redirect('signup');
//
//        } else {
//            echo " Sorry, the following problems were generated: ";
//
//            $messages = $user->getMessages();
//
//            foreach ($messages as $message){
//                echo $message->getMessage(), "<br/>";
//            }
//        }

        $this->view->disable();
    }
}

