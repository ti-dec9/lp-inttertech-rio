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
        $name = $this->request->getGet('name');
        $email = $this->request->getGet('email');
        $phone = $this->request->getGet('phone');
        $cnpj = $this->request->getGet('cnpj');
        $message = $this->request->getGet('message');

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'cnpj' => $cnpj,
            'message' => $message
        );

        $body = view('mail/template', $data);
        
        //Recipient
        $mailTo = 'contato@intertechrio.com.br';

        //Load librarie and config
        $sendmail = \Config\Services::email();
        $sendmail->setTo($mailTo);
        $sendmail->setFrom('mailto@intertechrio.com.br', 'Intertech Rio');
        $sendmail->setSubject("Contato - LP Controlador de temperatura west 6100");
        $sendmail->setMessage($body);
        $return = $sendmail->send();
        if ($return) {
            echo "TRUE";
        } else {
            echo "FALSE";
            //DEBUG MAIL 
           /* $data = $sendmail->printDebugger(['headers']);
            print_r($data); */
        }

        //Optional
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //Attachment
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
        //$email->attach($filename);
        
    }

    public function sendMailCta()
    {
        $name = $this->request->getGet('name');
        $email = $this->request->getGet('email');
        $phone = $this->request->getGet('phone');
        $cnpj = $this->request->getGet('cnpj');

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'cnpj' => $cnpj,
        );

        $body = view('mail/template', $data);
        
        //Recipient
        $mailTo = 'contato@intertechrio.com.br';

        //Load librarie and config
        $sendmail = \Config\Services::email();
        $sendmail->setTo($mailTo);
        $sendmail->setFrom('mailto@intertechrio.com.br', 'Intertech Rio');
        $sendmail->setSubject("Contato - LP Controlador de temperatura west 6100");
        $sendmail->setMessage($body);
        $return = $sendmail->send();
        if ($return) {
            echo "TRUE";
        } else {
            echo "FALSE";
            //DEBUG MAIL 
           /* $data = $sendmail->printDebugger(['headers']);
            print_r($data); */
        }

        //Optional
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //Attachment
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
        //$email->attach($filename);
        
    }
}
