<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Bundle\User\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController
{
    /**
     * Afficher la page d'authentification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request)
    {
        // Rédiriger vers la page spécifique si l'utilisateur est connecté
        $securityContext = $this->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $authChecker = $this->container->get('security.authorization_checker');
            $router = $this->container->get('router');

            if ($authChecker->isGranted('ROLE_ADMIN') || $authChecker->isGranted('ROLE_SUPERADMIN')) {
                return new RedirectResponse($router->generate('dashboard_index'));
            }

            if ($authChecker->isGranted('ROLE_CLIENT')) {
                return new RedirectResponse($router->generate('service_client_list'));
            }
        }

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }

        $data = array(
            'last_username' => $lastUsername,
            'csrf_token' => $csrfToken,
        );

        if ($error) {
            $data['error'] = $error;
        }

        return $this->render('UserBundle:Security:login.html.twig', $data);
    }
}
