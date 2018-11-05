<?php

use App\Forms\LoginForm;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->form = new LoginForm();
    }

}

