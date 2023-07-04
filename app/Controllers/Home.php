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
        $recaptcha = $this->request->getPost('g-recaptcha-response');
        $response_recaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdX6LgmAAAAAGJtx3hmwGhRGJs2ToI9c78WAi0e&response=" . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), TRUE);

        /* print_r($response_recaptcha);
        exit(); */

        //CLEAN PHONE NUMBER
        $phone =  str_replace("(", "", $phone);
        $phone =  str_replace(")", "", $phone);
        $phone =  str_replace("-", "", $phone);
        $phone =  str_replace(" ", "", $phone);

        //$response_recaptcha['success'] = TRUE;

        if ($response_recaptcha['success'] == TRUE) {
            try {
                /* TOKEN PIPEDRIVE */
                $api_token = '32bf6633d8212a83df97ab4a414c98d9fb59d04a';

                /* Cria a pessoa - PERSON */
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://intertechrio.pipedrive.com/v1/persons?api_token=$api_token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                "name": "'.$name.'",
                "owner_id": 14265490,
                "email": [
                    {
                    "value": "'.$email.'",
                    "primary": "true",
                    "label": "form west 6100"
                    }
                ],
                "phone": [
                    {
                    "value": "'.$phone.'",
                    "primary": "true",
                    "label": "mobile"
                    }
                ]
                }',
                CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'Cookie: __cf_bm=Jncw52BvHZSU9vP1AiwaAlzQnXk4qv9iitqO08X9F4U-1688433673-0-AZkhwbB5pZqaPkfBaUIzuebj8KQM37PetJEovHj9/6v2nqHFDWhaeSG+uVD/KGST9QW/j19KUu2qF0yXf0haLUk='
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                /* Trata o retorno da criação da pessoa */
                $response = json_decode($response, true);

                // Se a pessoa for cadastrada
                if ($response['success'] == TRUE) {
                    /* Cria o lead - LEAD */
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://intertechrio.pipedrive.com/v1/leads?api_token=$api_token",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "title": "'.$name.'",
                        "owner_id": 14265490,
                        "person_id": '.$response['data']['id'].'
                    }',
                    CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Accept: application/json',
                            'Cookie: __cf_bm=Jncw52BvHZSU9vP1AiwaAlzQnXk4qv9iitqO08X9F4U-1688433673-0-AZkhwbB5pZqaPkfBaUIzuebj8KQM37PetJEovHj9/6v2nqHFDWhaeSG+uVD/KGST9QW/j19KUu2qF0yXf0haLUk='
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);

                    /* Trata o retorno da criação da pessoa */
                    $response = json_decode($response, true);

                    if($response['success'] == TRUE) {
                        $data = array(
                            'message' => "Seus dados foram enviados com sucesso! <br> Em breve retornaremos o contato.",
                        );
                        echo view('send/return', $data);
                    } else {
                        $data = array(
                            'message' => "Algo deu errado, dados não enviados!",
                        );
                        echo view('send/return', $data);
                    }
                }            
            } catch (\Throwable $th) {
                throw $th;
            }

             /* $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'cnpj' => $cnpj,
                'message' => $message
            ); */
                
           /* $body = view('mail/template', $data);
            
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
                print_r($data); *
            } */
    
            //Optional
            //$email->setCC('another@emailHere');//CC
            //$email->setBCC('thirdEmail@emialHere');// and BCC
            //Attachment
            //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
            //$email->attach($filename);

        } else {
            //print_r($response_recaptcha);
            return redirect()->to('https://lp.intertechrio.com.br/lp/controlador-de-temperatura-west-6100');      
        }
    }

    public function contatoCta()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $cnpj = $this->request->getPost('cnpj');
        /* $recaptcha = $this->request->getPost('g-recaptcha-response');
        $response_recaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdYXLkmAAAAANkZa_c7NiDPTKzlKi-UI0I1oYLJ&response=" . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), TRUE); */
        
        //if ($response_recaptcha['success'] == TRUE) {
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
        /* } else {
            return redirect()->to('https://lp.intertechrio.com.br/lp/controlador-de-temperatura-west-6100');
        }  */   
    }
}
