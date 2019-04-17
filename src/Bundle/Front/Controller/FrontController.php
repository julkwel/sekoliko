<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/6/19
 * Time: 11:09 PM.
 */

namespace App\Bundle\Front\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Render FrontOffice Page
     */
    public function indexAction()
    {
        return $this->render('FrontBundle::index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendMailAction(Request $request)
    {
        $_mail = $request->request->get('email');
        $name = $request->request->get('name');
        $_message = $request->request->get('message');
        $_subject = $request->request->get('subject');

        $message = (new \Swift_Message($_subject))
            ->setFrom(array($_mail => $name))
            ->setTo('sekoliko.madagascar@gmail.com')
            ->setBody(
                $this->renderView(
                    'email/layout_email.email.twig',
                    ['name' => $name,'message'=>$_message]
                ),
                'text/html'
            );

//        $message_client = (new \Swift_Message($_subject))
//            ->setFrom('sekoliko.madagascar@gmail.com')
//            ->setTo($_mail)
//            ->setBody("Dear ".$name.","."\r\n".
//                "Merci pour votre message"."\r\n".
//                "Nous te contactera des que possible"."\r\n".
//                "Ekipa Sekoliko"
//            )
//        ;
        try{
            $message->setContentType('text/html');
            $_result = $this->get('mailer')->send($message);
//            $this->get('mailer')->send($message_client);
        }catch (\Exception $exception){
            dump($exception->getMessage());die();
        }


        $_headers = $message->getHeaders();
        $_headers->addIdHeader('Message-ID', uniqid().'@domain.com');
        $_headers->addTextHeader('MIME-Version', '1.0');
        $_headers->addTextHeader('X-Mailer', 'PHP v'.phpversion());
        $_headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);

        if ($_result) {
            return $this->render('FrontBundle::index.html.twig',array('result'=>$_result));
        }
    }
}
