<?php

use Phalcon\Mvc\Controller;
use App\Forms\LoginForm;


class ControllerBase extends Controller
{

    public function authorized()
    {
        if (!$this->isLoggedIn()) {
            return $this->response->redirect('user/login');
        }
    }

    public function isLoggedIn()
    {
        if ($this->session->has('name') and $this->session->has('email') and $this->session->has('created') and $this->session->has('updated')){
            return true;
        }

        return false;
    }

}
