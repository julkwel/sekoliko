<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Tests\Security;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginSecurityTest
 *
 * @package App\Tests\Security
 */
class LoginSecurityTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     *
     * @param $url
     * @param $httpMethod
     */
    public function testLoginUrl($url,$httpMethod)
    {
        $client = self::createClient();
        $client->request($httpMethod,$url);
        self::assertResponseStatusCodeSame(Response::HTTP_OK,$client->getResponse()->getStatusCode());
    }

    /**
     * @return Generator
     */
    public function urlProvider():?Generator
    {
        yield ['/login','GET'];
    }
}