<?php
namespace BaseCrm\Tests;

use BaseCrm\Client;
use BaseCrm\Scope;
use BaseCrm\Response;

/**
 * @covers BaseCrm\Scope
 */
class ScopeTest extends \PHPUnit_Framework_TestCase
{
    private $client;

    public function setup()
    {
        $this->client = $this->getMockBuilder('Client')
                             ->disableOriginalConstructor()
                             ->setMethods(array('getRequest', 'postRequest', 'putRequest', 'deleteRequest'))
                             ->getMock();
    }

    public function testAll()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint");
        $params = array();
        $response = $this->getMockBuilder("Response")->getMock();

        $this->client->expects($this->once())
             ->method('getRequest')
             ->with(
               "http://host.domain/endpoint.json",
               $params
             )
             ->willReturn($response);

        $result = $scope->all($params);
        $this->assertEquals($result, $response);

    }

    public function testAllWithNamespace()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint", array("namespace" => "contact"));
        $params = array();
        $response = new Response("200", array(
          array("contact" => array("name" => "foo"))
        ));

        $this->client->expects($this->once())
             ->method('getRequest')
             ->with(
               "http://host.domain/endpoint.json",
               $params
             )
             ->willReturn($response);

        $result = $scope->all($params);
        $this->assertEquals($result->data, array(
          array("name" => "foo")
        ));

    }

    public function testGet()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint");
        $params = array();
        $id = 12345;
        $result = $this->getMockBuilder("Response")->getMock();

        $this->client->expects($this->once())
             ->method('getRequest')
             ->with("http://host.domain/endpoint/$id.json")
             ->willReturn($response);

        $result = $scope->get($id);
        $this->assertEquals($result, $response);

    }

    public function testGetWithNamespace()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint", array("namespace" => "contact"));
        $params = array();
        $id = 12345;

        $response = new Response("200", array(
          "contact" => array("name" => "foo")
        ));

        $this->client->expects($this->once())
             ->method('getRequest')
             ->with(
               "http://host.domain/endpoint/$id.json"
             )
             ->willReturn($response);

        $result = $scope->get($id);
        $this->assertEquals($result->data, array("name" => "foo"));

    }

    public function testCreate()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint");
        $params = array();
        $result = $this->getMockBuilder("Response")->getMock();

        $this->client->expects($this->once())
             ->method('postRequest')
             ->with(
               "http://host.domain/endpoint.json",
               $params
             )
             ->willReturn($response);

        $result = $scope->create($params);
        $this->assertEquals($result, $response);

    }

    public function testUpdate()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint");
        $params = array();
        $id = 12345;

        $result = $this->getMockBuilder("Response")->getMock();

        $this->client->expects($this->once())
             ->method('putRequest')
             ->with(
               "http://host.domain/endpoint/$id.json",
               $params
             )
             ->willReturn($response);

        $result = $scope->update($id, $params);
        $this->assertEquals($result, $response);

    }

    public function testDestroy()
    {
        $scope = new Scope($this->client, "http://host.domain/endpoint");
        $params = array();
        $id = 12345;

        $result = $this->getMockBuilder("Response")->getMock();

        $this->client->expects($this->once())
             ->method('deleteRequest')
             ->with("http://host.domain/endpoint/$id.json")
             ->willReturn($response);

        $result = $scope->destroy($id);
        $this->assertEquals($result, $response);

    }

    public function testNamespaceOnCreate() {
        $scope = new Scope($this->client, "http://host.domain/endpoint", array("namespace" => "contact"));
        $params = array();
        $response = new Response("200", array(
          "contact" => array("name" => "foo")
        ));

        $this->client->expects($this->once())
             ->method('postRequest')
             ->with(
               "http://host.domain/endpoint.json",
               array("contact" => $params)
             )
             ->willReturn($response);

        $result = $scope->create($params);
        $this->assertEquals($result->data, array("name" => "foo"));

    }

    public function testNamespaceOnUpdate() {
        $scope = new Scope($this->client, "http://host.domain/endpoint", array("namespace" => "contact"));
        $params = array();
        $id = 12345;

        $response = new Response("200", array(
          "contact" => array("name" => "foo")
        ));

        $this->client->expects($this->once())
             ->method('putRequest')
             ->with(
               "http://host.domain/endpoint/$id.json",
               array("contact" => $params)
             )
             ->willReturn($response);

        $result = $scope->update($id, $params);
        $this->assertEquals($result->data, array("name" => "foo"));

    }
}

