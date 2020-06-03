<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Front;

use App\Controller\AbstractBaseController;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontController.
 */
class FrontController extends AbstractBaseController
{
    /**
     * @Route("/",name="front_route")
     *
     * @return Response
     */
    public function redirectToLogin(): Response
    {
        return $this->render('front/content/_index.html.twig');
    }

    /**
     * @Route("/send_email", name="send_contact_email", methods={"POST","GET"}, options={"expose"=true})
     *
     * @param Request      $request
     * @param Swift_Mailer $mailer
     *
     * @return JsonResponse
     */
    public function sendEmail(Request $request, Swift_Mailer $mailer)
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'] ?? 'Sekoliko';
        $email = $data['email'] ?? 'sekoliko.mada@gmail.com';
        $subject = $data['subject'] ?? 'No subject';
        $message = $data['message'] ?? 'No message';

        $res = ['status' => 'error'];

        try {
            $swMessage = (new Swift_Message())
                ->setSubject($subject)
                ->setFrom($email, $name)
                ->setCc('julienrajerison5@gmail.com')
                ->setTo($this->getParameter('default_email'))
                ->setBody($message, 'text/plain');

            $mailer->send($swMessage);
            $res = ['status' => 'success'];
        } catch (Exception $exception) {
            $res['reason'] = $exception->getMessage();
        }

        return $this->json($res);
    }
}
