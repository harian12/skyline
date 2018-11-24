<?php

use App\Forms\artikelForm;

class ArtikelController extends ControllerBase
{
    public $artikelForm;
    public $modelartikel;

    public function initialize(){
        $this->authorized();
        $this->artikelForm = new artikelForm();
        $this->modelartikel = new Artikel();
    }

    public function indexAction()
    {

    }

    public function tambahAction()
    {
        $this->tag->setTitle('Buat Artikel');
        $this->view->form = new artikelForm();
    }

    public function tambahSimpanAction()
    {

        if (!$this->request->isPost()){
            return $this->response->redirect('user/login');
        }

//        //cek token
//        if (!$this->security->checkToken()){
//            $this->flashSession->error('Invalid Token');
//            return $this->response->redirect('tambah/artikel');
//        }

        $this->artikelForm->bind($_POST,$this->modelartikel);

        if (!$this->artikelForm->isValid()){
            foreach ($this->artikelForm->getMessages() as $message) {
                $this->flashSession->error($message);
                $this->dispatcher->forward([
                   'controller' => $this->router->getControllerName(),
                    'action' => 'tambah'
                ]);
                return;
            }
        }
        if ($this->request->getPost('post') != null){
            $this->modelartikel->setIsPublic(1);
        } else {
            $this->modelartikel->setIsPublic(0);
        }


        $this->modelartikel->setUserId($this->session->get('id'));
        $this->modelartikel->setCreated(time());
        $this->modelartikel->setUpdated(time());

echo 'jhgh';
        if (!$this->modelartikel->save()){
            foreach ($this->modelartikel->getMessages() as $m){
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action' => 'tambah'
                ]);
                return;
            }
        }


        $this->flashSession->success('Artkel Berhasil Disimpan');
        return $this->response->redirect('tambah/artikel');


    }

}

