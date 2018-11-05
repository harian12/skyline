<?php
/**
 * Created by PhpStorm.
 * User: skyan
 * Date: 26/10/18
 * Time: 13:29
 */

namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
//validasi
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;

class LoginForm extends Form
{

    public function initialize()
    {

        $email = new Text(
            'email',[
                'class' => 'form-control mb-3',
                'placeholder' => 'Email Address'
            ]
        );
        $email->addValidators([
           new PresenceOf([ 'message' => 'Email tidak Boleh Kosong' ]),
            new Email([ 'Email Anda tidak Valid'])
        ]);
        $this->add($email);


        $password = new Password(
            'password',[
            'class' => 'form-control',
            'placeholder' => 'Password'
        ]);
        $password->addValidators([
           new PresenceOf([ 'message' => 'Password tidak Boleh Kosong']),
            new StringLength(['min' => 6, 'message' => 'Password 6 karakter'])
        ]);
        $this->add($password);

        $cek = new Check(
            'cek',[
                'class' => '',
            ]
        );
            $this->add($cek);

        $submit = new Submit(
            'submit',[
            'class' => 'btn btn-primary mb-2',
            'value' => 'Login'
        ]);
        $this->add($submit);
    }

}