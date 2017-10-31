<?php

namespace TodoListBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
class DefaultControllerTest extends WebTestCase
{
    
    const PATH = '/api/task';
    /**
     * 
     */
    public function testCreateNew()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('POST', self::PATH,['name'=>'test']);

        $this->assertEquals(Response::HTTP_ACCEPTED, $client->getResponse()->getStatusCode(), 'New ');
        $this->assertTrue($client->getResponse()->headers->has('Location'));
        $id = substr(strrchr($client->getResponse()->headers->get('Location'), "/"), 1); ;
        
        $client->request('GET', self::PATH.'/'.$id);
        
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode(),'If item exists the response is OK');
        $response = json_decode($client->getResponse()->getContent(), true); 
        $this->assertEquals('test',$response['name'], 'We can receive name test');
        $this->assertFalse($response['isRead'], 'by default isRed is false ');
        
        $this->assertEquals(date('Y-m-d H:i'), (new \DateTime($response['createdAt']))->format('Y-m-d H:i') , 'Create date is today');
        
        $client->request('PUT', self::PATH.'/'.$id, ['name'=>'test2', 'isread'=>1]);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode(), 'The PUT returns no content');
       
        $client->request('GET', self::PATH.'/'.$id);
        $response = json_decode($client->getResponse()->getContent(), true); 
        $this->assertEquals('test2',$response['name'], 'Name should be changed');
        $this->assertTrue($response['isRead'], 'isRead should become true after update');
        
        $client->request('DELETE', self::PATH.'/'.$id);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode(), 'Delete does not return content');
        
        $client->request('GET', self::PATH.'/'.$id);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode(), 'Once item deleted we can not get it anymore');
        
        $client->request('PUT', self::PATH.'/'.$id);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode(),'Once item deleted we can not change it anymore');
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
