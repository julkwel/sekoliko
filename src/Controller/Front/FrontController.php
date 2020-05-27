<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Front;

use App\Controller\AbstractBaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
}
