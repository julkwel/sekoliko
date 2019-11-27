<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Helper;

use App\Entity\History;
use App\Entity\User;
use App\Manager\SekolikoEntityManager;

/**
 * Class History.
 */
class HistoryHelper extends SekolikoEntityManager
{
    /**
     * History of user.
     *
     * @param string $action
     * @param User   $user
     */
    public function addHistory(string $action, User $user)
    {
        $history = new History();
        $history->setAction($action);
        $history->setUserAct($this->getUser());
        $history->setUser($user);

        $this->em->persist($history);
        $this->em->flush($history);
    }
}
