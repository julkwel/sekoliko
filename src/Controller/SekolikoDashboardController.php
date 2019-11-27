<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoDashboardController
 *
 * @package App\Controller
 */
class SekolikoDashboardController extends AbstractBaseController
{
    /**
     * @Route("/admin/dashboard",name="admin_dashboard",methods={"POST","GET"})
     */
    public function dashboardController()
    {
        return $this->render(
            'admin/content/_dashboard_admin.html.twig',
            [
                'data' => 'Hello',
            ]
        );
    }
}
