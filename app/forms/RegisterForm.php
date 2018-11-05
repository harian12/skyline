<?php

namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
// use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
// Validasi form
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class RegisterForm extends Form
{
    public function initialize()
    {
    
        // field name
            $name = new Text(
                'name',[
                    'maxlength' => 30, 
                    'placeholder' => 'Enter Full Name',
                    'class' => 'form-control'
                ]
                );
        // validasi form nama
            $name->addValidator(
                new PresenceOf(['message' => 'Nama tidak Boleh Kosong'])
            );
            $this->add($name);
            
            
        // field email
            $email = new Text(
                'email',[
                    'placeholder' => 'Enter Email Address',
                    'class' => 'form-control'
                ]
                );
        // validasi form email
            $email->addValidators([
                new PresenceOf(['message' => 'E-mail tidak Boleh Kosong']),
                new Email(['message' => 'E-mail Anda tidak Valid'])
            ]);
            $this->add($email);


        // submit register button
            $register = new Submit(
                'submit',[
                    'value' => 'Register',
                    'class' => 'btn btn-primary'
                ]
                );
            $this->add($register);
        
        
        //field password
            $password = new Password(
                'password',[
                    'class' => 'form-control',
                    'placeholder' => 'Enter Your Password'
                ]
            );

            $password->addValidators([
                new PresenceOf(["message" => 'Password tidak Boleh Kosong']),
                new StringLength(['min' => 6,'message' => 'Password minimal 6 karakter']),
                new Confirmation(['with' => 'konfirm_password', 'message' => 'Silahkan Konfirmasi Password Anda'])
            ]);
            $this->add($password);

        // field konfirmasi password
            $konfimPassword = new Password(
                'konfirm_password',[
                    'class' => 'form-control',
                    'placeholder' => 'Konfirmasi Password'
                ]
            );

            $konfimPassword->addValidators([
                new PresenceOf(['message' => 'Konfirmasi Password tidak Boleh Kosong'])
            ]);
            $this->add($konfimPassword);

    }
}
?>