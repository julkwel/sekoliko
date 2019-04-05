<?php
namespace App\Shared\Services\Services;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
//use Ariary\PaiementBundle\Response as RestResponse;
//use Ariary\PaiementBundle\Lib\PusherInstance;

class Paiement
{
    private $public_key;
    private $private_key;
    private $client_id;
    private $client_secret;
    private $util;
    private $site_url;
    private $token=null;
    const URL_AUTH = "https://pro.ariarynet.com/oauth/v2/token";
    const URL_PAIEMENT = "https://pro.ariarynet.com/api/paiements";
    const URL_PAIE =  "https://moncompte.ariarynet.com/payer/";
    const URL_RESULTAT =  "https://www.techzara.org/sekoliko/admin/paiement/terminer";

    /**
     * Paiement constructor.
     * @param $public_key
     * @param $private_key
     * @param $client_id
     * @param $client_secret
     * @param RequestStack $requestStack
     * @param Util $util
     */
    public function __construct($public_key, $private_key, $client_id, $client_secret,RequestStack $requestStack,Util $util)
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->util=$util;
	    $this->site_url="https://www.techzara.org/sekoliko/admin/paiement/new"; //url du site inscrit dans pro.ariarynet.com
    }

    /**
     * @return null
     * @throws \Exception
     */
    private function getAccess(){
        if($this->token!=null)return $this->token;
        $param=array(
            'client_id'=>$this->client_id,
            'client_secret'=>$this->client_secret,
            'grant_type'=>'client_credentials'
        );
        $json= json_decode($this->util->sendCurl(self::URL_AUTH,"POST",array(),$param));
        if(isset($json->error)){
            throw new Exception($json->error.": ".$json->error_description);
        }
        $this->token=$json->access_token;
        return $json->access_token;
    }

    /**
     * @param $idpaiement
     * @return mixed
     * @throws \Exception
     */
    public function resultPaiement($idpaiement){
        $idpaiement=$this->util->decrypter($this->private_key,$idpaiement);
        $params=array(
            "idpaiement"=>$idpaiement
        );
        $res=$this->send(self::URL_RESULTAT,$params);
        return json_decode($res);
    }

    /**
     * @param $url
     * @param array $params_to_send
     * @return bool|int|string
     * @throws \Exception
     */
    private function send($url,array $params_to_send){
        $params_crypt=$this->util->crypter($this->public_key,json_encode($params_to_send));
        $params=array(
            "site_url"=>$this->site_url,
            "params"=>$params_crypt
        );
        $headers=array("Authorization:Bearer ".$this->getAccess());
        $json=$this->util->sendCurl($url,"POST",$headers,$params);
        $error=json_decode($json);
        if(isset($error->error)){
            throw new Exception($error->error.": ".$error->error_description);
        }
        return $this->util->decrypter($this->private_key,$json);
    }

    /**
     * @param $idpanier
     * @param $montant
     * @param $nom
     * @param $reference
     * @param $adresseip
     * @return RedirectResponse
     * @throws \Exception
     */
    public function initPayAriary($idpanier,$montant,$nom,$reference,$adresseip){
        $now=new \DateTime();
        $params=array(
            "unitemonetaire"=>"Ar",
            "adresseip"=>$adresseip,
            "date"=>$now->format('Y-m-d H:i:s'),
            "idpanier"=>$idpanier,
            "montant"=>$montant,
            "nom"=>$nom,
            "reference"=>$reference
        );
        $id=$this->send(self::URL_PAIEMENT,$params);
        return new RedirectResponse(self::URL_PAIE.$id);
    }
}