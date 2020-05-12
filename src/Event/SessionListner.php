<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Event;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SessionListner.
 */
class SessionListner
{
    /** @var ContainerInterface */
    private $container;

    /** @var RouterInterface */
    private $router;

    /** @var KernelInterface */
    private $kernel;

    /**
     *
     * SessionListner constructor
     *
     * @param ContainerInterface $container
     * @param RouterInterface    $router
     * @param KernelInterface    $kernel
     */
    public function __construct(ContainerInterface $container, RouterInterface $router, KernelInterface $kernel)
    {
        $this->container = $container;
        $this->router = $router;
        $this->kernel = $kernel;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $security = $this->container->get('security.authorization_checker');

        if (($this->kernel->getEnvironment() === 'prod') && $event && $security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            $event->setResponse(new RedirectResponse($this->router->generate('app_logout')));
        }
    }
}
