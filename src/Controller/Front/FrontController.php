<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Front;

use App\Controller\AbstractBaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontController.
 */
class FrontController extends AbstractBaseController
{
    /**
     * @Route("/",name="front_route")
     *
     * @return RedirectResponse
     */
    public function redirectToLogin(): RedirectResponse
    {
        return $this->redirectToRoute('app_login');
    }
}
