<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Front;

use App\Controller\AbstractBaseController;
use App\Entity\AdministrationType;
use App\Entity\Administrator;
use App\Entity\User;
use App\Form\OrganisationType;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    /**
     * @Route("/create/my-organisation", name="new_organisation")
     *
     * @param Request                      $request
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function createNewOrganisation(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(OrganisationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $libelle = $data['userType'] ?? '';
                $type = new AdministrationType();
                $type->setLibelle($libelle);
                $this->manager->persist($type);

                $user = new User();
                $user
                    ->setEtsName($data['organisation'])
                    ->setUsername($data['login'])
                    ->setNom($data['username'])
                    ->setRoles(['ROLE_ADMIN'])
                    ->setIsEnabled(true)
                    ->setPassword($encoder->encodePassword($user, $data['password']));

                $admin = new Administrator();
                $admin->setUser($user);
                $admin->setType($type);

                $this->manager->persist($admin);
                $this->manager->flush();
                $this->addFlash('success', 'Vous pouvez connecter avec votre utilisateur !');

                return $this->redirectToRoute('front_route');
            } catch (Exception $exception) {
                $this->addFlash('error', 'Une erreur c\'est produite !');

                return $this->redirectToRoute('front_route');
            }
        }

        return $this->render('front/organisation/_create_orga.html.twig', ['form' => $form->createView()]);
    }
}
