<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller\Dashboard;

use App\Controller\AbstractBaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoDashboardController.
 *
 * @Route("/{_locale}/admin")
 */
class SekolikoDashboardController extends AbstractBaseController
{
    /**
     * @Route("/dashboard",name="admin_dashboard",methods={"POST","GET"})
     *
     * @return Response
     */
    public function dashboardController(): Response
    {
        return $this->render(
            'admin/content/_dashboard_admin.html.twig',
            [
                'data' => 'Hello',
            ]
        );
    }
}
