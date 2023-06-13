<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function sendMail()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $cnpj = $this->request->getPost('cnpj');
        $message = $this->request->getPost('message');

        $data = array(
            'name' => $name,
            'emailUser' => $email,
            'phone' => $phone,
            'cnpj' => $cnpj,
            'message' => $message
        );

        $body = view('mail/template', $data);
        
        $mailTo = 'xploter13@gmail.com';

        //Load librarie and config
        $sendmail = \Config\Services::email();
        $sendmail->setTo($mailTo);
        $sendmail->setFrom('mailto@intertechrio.com.br', 'Intertech Rio');
        $sendmail->setSubject("Ativação de conta");
        $sendmail->setMessage($body);
        $sendmail->send();

        /*
         * DEBUG MAIL */
        $data = $sendmail->printDebugger(['headers']);
        print_r($data);
        exit();

        //Optional
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //Attachment
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
        //$email->attach($filename);

        /* if ($email->send()) {
            echo "TRUE";
        } else {
            echo "FALSE";
        } */
        
    }
}
