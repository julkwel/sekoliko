<?php
/**
 * Created by PhpStorm.
 * User: msi
 * Date: 29/01/2016
 * Time: 10:46
 */

namespace App\Shared\Services\Services;


use Sinner\Phpseclib\Crypt\Crypt_TripleDES;
use Sinner\Phpseclib\Crypt\Crypt_Hash;
use Sinner\Phpseclib\Crypt\Crypt_AES;
use Sinner\Phpseclib\Math\Math_BigInteger;

use Symfony\Component\HttpFoundation\Response;

class Util
{
    private $encrypter;

    /**
     * Util constructor.
     */
    public function __construct()
    {
        $this->encrypter=new Crypt_TripleDES();
    }


    public function sendCurl($url,$type,$headers,$params){
        //echo new Response(json_encode($params));
        $curl=curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        if(strtoupper($type)=='POST'){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$params);
        }else{
            $query=http_build_query($params);
            $url.="?".$query;
        }
        curl_setopt($curl,CURLOPT_URL,$url);
        $result=curl_exec($curl);
		if(curl_errno($curl)){
			throw new \Exception('Curl error: ' . curl_error($curl));
		}
        curl_close($curl);
        return $result;
    }

    public function crypter($key,$data){
        $this->encrypter->setKey($key);
        return $this->encrypter->encrypt($data);
    }

    public function decrypter($key,$data){
        $this->encrypter->setKey($key);
        return $this->encrypter->decrypt($data);
    }
}