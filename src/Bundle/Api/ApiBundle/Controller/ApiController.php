<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/18/19
 * Time: 1:57 PM.
 */

namespace App\Bundle\Api\ApiBundle\Controller;

use App\Shared\Entity\SkMatiere;
use App\Shared\Services\Utils\ServiceName;
use FOS\UserBundle\Model\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function getTocken(UserInterface $_user, JWTTokenManagerInterface $JWTManager)
    {
        return new JsonResponse(['token' => $JWTManager->create($_user)]);
    }

    /**
     * @return \App\Shared\Repository\RepositorySkSlideManager|object
     */
    public function getSlideManager()
    {
        return $this->get(ServiceName::SRV_METIER_SLIDE);
    }

    /**
     * @return \App\Shared\Repository\RepositorySkParticipantsManager|object
     */
    public function getParticipantManager()
    {
        return $this->get(ServiceName::SRV_METIER_PARTICIPANTS);
    }

    /**
     * @return \App\Shared\Repository\RepositoryPartenairesManager|object
     */
    public function getPartenaireManager()
    {
        return $this->get(ServiceName::SRV_METIER_PARTENAIRES);
    }

    /**
     * @return \App\Shared\Repository\RepositorySkOrganisateurManager|object
     */
    public function getOrganisateurManager()
    {
        return $this->get(ServiceName::SRV_METIER_ORGANISATEUR);
    }

    /**
     * @return array
     */
    public function allEvent()
    {
        return $this->getSlideManager()->getAllSkSlide();
    }

    /**
     * @return mixed
     */
    public function getNewEvent()
    {
        return $this->allEvent()[0];
    }

    /**
     * @param $_name
     * @param $_data
     *
     * @return JsonResponse
     */
    public function response($_name, $_data)
    {
        $_list = new JsonResponse();
        $_list->setData(array($_name => $_data));
        $_list->setStatusCode(200);
        $_list->headers->set('Content-Type', 'application/json');
        $_list->headers->set('Access-Control-Allow-Origin', '*');

        return $_list;
    }

    /**
     * @return JsonResponse
     */
    public function participantsAction()
    {
        $_new_event = $this->getNewEvent();
        $_participant_list = $this->getParticipantManager()->getParticipantsEvent($_new_event);

        $_participant_lists = [];
        foreach ($_participant_list as $key => $_participant) {
            $_participant_lists[$key]['id'] = $_participant->getId();
            $_participant_lists[$key]['evenement'] = $_participant->getActEvent()->getSldEventTitle();
            $_participant_lists[$key]['universite'] = $_participant->getPartUniversite();
            $_participant_lists[$key]['team'] = $_participant->getPartTeam();
            $_participant_lists[$key]['image'] = $_participant->getPartImage();
        }

        return $this->response('participant_list', $_participant_lists);
    }

    /**
     * @param Request $_request
     *
     * @return JsonResponse
     */
    public function newParticipantsAction(Request $_request)
    {
        $_participant = new SkMatiere();

        $_image = $_request->files->get('image');
        $_event = $this->getSlideManager()->getSkSlideById((int) $_request->get('event'));
        $_participant->setPartTeam($_request->get('team'));
        $_participant->setPartDescription($_request->get('description'));
        $_participant->setActEvent($_event);
        $_participant->setPartUniversite($_request->get('universite'));
        $this->getParticipantManager()->addParticipants($_participant, $_image);
        try {
            return $this->response('status', Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->response('status', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Liste des partenaires des evenements.
     *
     * @return JsonResponse
     */
    public function partenairesListAction()
    {
        $_new_event = $this->getNewEvent();
        $_partenaires_list = $this->getPartenaireManager()->getPartenairesEvent($_new_event);

        $_partenaires_lists = [];
        foreach ($_partenaires_list as $key => $_partenaire) {
            $_partenaires_lists[$key]['id'] = $_partenaire->getId();
            $_partenaires_lists[$key]['evenement'] = $_partenaire->getActEvent()->getSldEventTitle();
            $_partenaires_lists[$key]['societe'] = $_partenaire->getParteEntite();
            $_partenaires_lists[$key]['contribution'] = $_partenaire->getParteContribution();
            $_partenaires_lists[$key]['image'] = $_partenaire->getParteImage();
        }

        return $this->response('partenaires_list', $_partenaires_lists);
    }

    /**
     * Liste des organisateurs d'un evenement.
     *
     * @return JsonResponse
     */
    public function organisateurAction()
    {
        $_new_event = $this->getNewEvent();
        $_organisateur_list = $this->getOrganisateurManager()->getOrganisateurEvent($_new_event);

        $_organisateur_lists = [];
        foreach ($_organisateur_list as $key => $_organisateur) {
            $_organisateur_lists[$key]['id'] = $_organisateur->getId();
            $_organisateur_lists[$key]['evenement'] = $_organisateur->getActEvent()->getSldEventTitle();
            $_organisateur_lists[$key]['name'] = $_organisateur->getOrgName();
            $_organisateur_lists[$key]['description'] = $_organisateur->getOrgDecription();
            $_organisateur_lists[$key]['responsabilite'] = $_organisateur->getOrgResponsabilite();
            $_organisateur_lists[$key]['image'] = $_organisateur->getOrgImage();
        }

        return $this->response('partenaires_list', $_organisateur_lists);
    }
}
