<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Tests\Security;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class LoginTest
 *
 * @package App\Tests\Security
 */
class LoginTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     *
     * @param $url
     * @param $httpMethod
     */
    public function testLogin($url, $httpMethod)
    {
        $client = self::createClient();
        $client->request($httpMethod, $url);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @return Generator
     */
    public function urlProvider(): ?Generator
    {
        yield ['/login', 'GET'];
    }
}
