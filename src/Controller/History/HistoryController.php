<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\History;

use App\Controller\AbstractBaseController;
use App\Entity\User;
use App\Repository\HistoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HistoryController.
 */
class HistoryController extends AbstractBaseController
{
    /**
     * @param User              $user
     * @param HistoryRepository $repository
     *
     * @return Response
     *
     * @Route("/history/{id}",name="history_user",methods={"POST","GET"})
     */
    public function showHistory(User $user, HistoryRepository $repository)
    {
        return $this->render(
            'admin/content/History/_history.html.twig',
            [
                'histories' => $repository->userHistory($user),
                'user' => $user,
            ]
        );
    }
}
