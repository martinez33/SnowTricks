<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/03/2018
 * Time: 16:17
 */

namespace App\Tests\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TricksListControllerTest extends WebTestCase
{
    public function testShowTricks()
    {
        $client = static::createClient();

        $container = $client->getContainer();



        $crawler = $client->request('GET', '/tricks');
        $response = $client->getResponse();
        $responseContent = $response->getContent();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($, $responseContent);

    }
}