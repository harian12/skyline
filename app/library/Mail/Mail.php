<?php
/**
 * Created by PhpStorm.
 * User: skyan
 * Date: 05/11/18
 * Time: 11:23
 */

use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View;

require_once BASE_PATH .'/vendor/autoload.php';

use Swift_Mailer as SwiftMailer;
use Swift_Message as SwiftMessage;
use Swift_SmtpTransport as SwiftSmtpTransport;


class Mail extends Component
{
    protected $transport;

    private function getTemplate($keys, $params)
    {
        $render = $this->view->getRender(
          'templates',
          $keys,
          $params,
          function ($view){
              $view->setRenderLevel(View::LEVEL_LAYOUT);
          }
        );

        if (!empty($render)){
            return $render;
        }

        return $this->view->getContent();
    }


    //send email
    public function  send($to, $templateKey, $params = [])
    {
        $body = $this->getTemplate($templateKey, $params);
        if (!$body){
            throw new \Exception('You need to create templates email');
        }

        if (empty($params['subject'])){
            $subject = 'Konfirmasi Email';
        } else {
            $subject = $params['subject'];
        }

        $mail = $this->config->mail;

        //buat pesan
        $message = new SwiftMessage($subject);
        $message
            ->setTo([$to])
            ->setFrom([$mail->formEmail => $mail->formName])
            ->setBody($body, 'text/html');

        if (!$this->transport) {
            $transport = new SwiftSmtpTransport($mail->smtp->server, $mail->smtp->port);
            $transport->setUsername($mail->smtp->username);
            $transport->setPassword($mail->smtp->password);
            $this->transport = $transport;
        }

        $mailer = new SwiftMailer($this->transport);
        return $mailer->send($message);
    }

}
