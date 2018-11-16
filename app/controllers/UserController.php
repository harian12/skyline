<?php

use Phalcon\Http\Request;

use App\Forms\LoginForm;
use App\Forms\RegisterForm;

class UserController extends ControllerBase
{

    public $loginForm;
    public $userModel;

    public function onConstruct()
    {

    }

    public function initialize()
    {
        $this->loginForm = new LoginForm();
        $this->userModel = new Users();

    }


    public function indexAction()
    {

    }

    public function loginAction()
    {
        $this->tag->setTitle('Phalcon :: Login');
        $this->view->form = new LoginForm();
    }


    public function loginSubmitAction()
    {
        // cek request
        if (!$this->request->getPost()) {
            return $this->response->redirect('user/login');
        }


        //validasi token
        if (!$this->security->checkToken()){
            $this->flashSession->error('Invalid Token');
            return $this->response->redirect('user/login');
        }
        //end validasi token



        $this->loginForm->bind($_POST, $this->userModel);

        if (!$this->loginForm->isValid()){
            foreach ($this->loginForm->getMessages() as $message){
               $this->flashSession->error($message);
               $this->dispatcher->forward(
                   [
                       'controller' => $this->router->getControllerName(),
                       'action' => 'login'
                   ]
               );

               return;

            }
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = Users::findFirst([
            'email = :email:',
            'bind' => [
                'email' => $email,
            ]
        ]);


            if ($user) {
                if ($this->security->checkHash($password, $user->password)) {

                    $this->flashSession->success("Login Berhasil");
                    return $this->response->redirect('user/login');
                }
            } else {

                $this->security->hash(rand());

            }


        $this->flashSession->error("Login Gagal");
        return $this->response->redirect('user/login');


    }


    public function registerAction()
    {
        $this->tag->setTitle('Phalcon :: Register');
        $this->view->form = new RegisterForm();
    }

    public function registerSubmitAction()
    {
        $user = new Users();
        $form = new RegisterForm();
//        $email = new Mail();

        // cek data tipe post
        if (!$this->request->isPost()){
            return $this->response->redirect('user/register');
        }

        $form->bind($_POST, $user);
        // cek validasi
        if(!$form->isValid()){
            $messages = $form->getMessages();

            foreach ($messages as $message){
                $this->flashSession->error($message);

                $this->dispatcher->forward(
                    [
                        'controller' => $this->router->getControllerName(),
                        'action' => 'register'
                    ]);

                return;
            }
        }

        $user->setPassword($this->security->hash($_POST['password']));
        $user->setActive(1);
        $user->setCreated(time());
        $user->setUpdated(time());


        if(!$user->save()){
            foreach ($user->getMessages() as $m){
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action' => 'register'
                ]);
            }
            return;
        }

//        $params = [
//            'name' => $this->request->getPost('name'),
//            'link' => "http://localhost/skyline"
//        ];
//
//            //kirim email => signup tampilan pesan di templates
//        $email->send($this->request->getPost('email', ['trim', 'email'], 'signup' , $params));

        $this->flashSession->success('Registrasi Berhasil');
        return $this->response->redirect('user/login');

        $this->view->disable();
    }

}











