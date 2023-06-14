<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function contato()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $cnpj = $this->request->getPost('cnpj');
        $message = $this->request->getPost('message');

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
        //$mailTo = 'fernando@dec9.com.br';

        //Load librarie and config
        $sendmail = \Config\Services::email();
        $sendmail->setTo($mailTo);
        $sendmail->setFrom("$email", 'Intertech Rio');
        $sendmail->setSubject("Contato - LP Controlador de temperatura west 6100 - Lead Form Contato");
        $sendmail->setMessage($body);
        $return = $sendmail->send();
        if ($return) {
            $data = array(
                'message' => "Seus dados foram enviados com sucesso! <br> Em breve retornaremos o contato.",
            );
            echo view('send/return', $data);
        } else {
            $data = array(
                'message' => "Algo deu errado, dados não enviados!",
            );
            echo view('send/return', $data);
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

    public function contatoCta()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $cnpj = $this->request->getPost('cnpj');

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'cnpj' => $cnpj,
        );

        $body = view('mail/template', $data);
        
        //Recipient
        $mailTo = 'contato@intertechrio.com.br';
        //$mailTo = 'fernando@dec9.com.br';

        //Load librarie and config
        $sendmail = \Config\Services::email();
        $sendmail->setTo($mailTo);
        $sendmail->setFrom("$email", 'Intertech Rio');
        $sendmail->setSubject("Contato - LP Controlador de temperatura west 6100 - Lead Form CTA WHATSAPP");
        $sendmail->setMessage($body);
        $return = $sendmail->send();
        if ($return) {
            header('location:https://wa.me/5521996072513?text=Gostaria%20de%20informações%20sobre%20o%20produto%20CONTROLADOR%20DE%20TEMPERATURA%20E%20PROCESSOS%20WEST%206100+%20|%20P6100+');
        } else {
            $data = array(
                'message' => "Algo deu errado, dados não enviados!",
            );
            echo view('send/return', $data);
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
