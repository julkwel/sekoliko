<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Event;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SessionListner.
 */
class SessionListner
{
    private $container;
    private $router;

    /**
    *
    * SessionListner constructor
    *
    * @param ContainerInterface $container
    * @param RouterInterface    $router
    */
    public function __construct(ContainerInterface $container, RouterInterface $router)
    {
        $this->container = $container;
        $this->router = $router;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $security = $this->container->get('security.authorization_checker');

        if ($event && $security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            $event->setResponse(new RedirectResponse($this->router->generate('app_logout')));
        }
    }
}
