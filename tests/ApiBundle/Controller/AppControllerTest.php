<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testGetLatestAppVersionAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/app/latest/version');

        $this->assertContains('No application data found', $client->getResponse()->getContent());
    }
}
