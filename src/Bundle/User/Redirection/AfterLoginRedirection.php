<?php

namespace App\Bundle\User\Redirection;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $_router;
    protected $_authorization_checker;
    protected $_container;

    public function __construct(Router $_router, AuthorizationChecker $_authorization_checker, Container $_container)
    {
        $this->_router = $_router;
        $this->_authorization_checker = $_authorization_checker;
        $this->_container = $_container;
    }

    /**
     * @param Request        $_request
     * @param TokenInterface $_token
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function onAuthenticationSuccess(Request $_request, TokenInterface $_token)
    {
        $_auth_checker = $this->_container->get('security.authorization_checker');
        $_router = $this->_container->get('router');

        return new RedirectResponse($_router->generate('dashboard_index'));
    }
}
