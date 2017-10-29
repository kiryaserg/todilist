<?php

namespace TodoListBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
class DefaultControllerTest extends WebTestCase
{
    /**
     * 
     */
    public function testCreateNew()
    {
        $client = $this->createAuthenticatedClient();

        $crawler = $client->request('POST', '/api/task',['name'=>'test']);

        $this->assertEquals(Response::HTTP_ACCEPTED, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->has('Location'));
    }
    
      /**
     * 
     */
    public function testErrorWhenNameNotSendOnCreateNew()
    {
        $client = $this->createAuthenticatedClient();

        $crawler = $client->request('POST', '/api/task');

        $this->assertEquals(Response::HTTP_NOT_ACCEPTABLE, $client->getResponse()->getStatusCode());
    }
    
    protected function createAuthenticatedClient($username = 'test', $password = 'test')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
                '_username' => $username,
                '_password' => $password,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}
