<?php
/**
 * Created by PhpStorm.
 * User: skyan
 * Date: 21/11/18
 * Time: 22:23
 */

namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
//validasi bro
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Email;


class artikelForm extends Form
{

    public function initialize()
    {
        //judul
            $judul = new Text('judul',[
                'class' => 'form-control',
                'placeholder' => 'Judul Artikel'
            ]);

            $judul->addValidators([
                new PresenceOf(['message' => 'Judul tidak Boleh Kosong'])
            ]);
            $this->add($judul);

         //isi artikel
            $isi = new TextArea('isi',[
               'class' => 'form-control',
               'placeholder' => 'Isi Artikel',
                'row' => '5'
            ]);

            $isi->addValidators([
                new PresenceOf([ 'message' => 'Isi Artikel tidak Boleh Kosong']),
                new StringLength(['min' => '50', 'message' => 'Isi Artikel Minimal 50 Karakter'])
            ]);
            $this->add($isi);

         //save
            $save = new Submit('save',[
                'class' => 'btn btn-warning',
                'value' => 'Simpan',
                'name' => 'save'
            ]);
            $this->add($save);

         //post
            $post = new Submit('post',[
                    'name' => 'post',
                    'value' => 'Post Artikel',
                    'class' => 'btn btn-primary'
                ]);
            $this->add($post);



    }

}