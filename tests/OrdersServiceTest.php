<?php
namespace BaseCRM;

class OrdersServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->orders, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->orders, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->orders, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->orders, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->orders, 'destroy'));
  }

  public function testAll()
  {
    $orders = self::$client->orders->all(['page' => 1]);
    $this->assertInternalType('array', $orders);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$order);
    $this->assertGreaterThanOrEqual(1, count(self::$order));
 
  }

  public function testGet()
  {
    $foundOrder = self::$client->orders->get(self::$order['id']);
    $this->assertInternalType('array', $foundOrder);
    $this->assertEquals($foundOrder['id'], self::$order['id']);
 
  }

  public function testUpdate()
  {
    $updatedOrder = self::$client->orders->update(self::$order['id'], self::$order);
    $this->assertInternalType('array', $updatedOrder);
    $this->assertEquals($updatedOrder['id'], self::$order['id']);
 
  }

  public function testDestroy()
  {
    $newOrder = self::createOrder();
    $this->assertTrue(self::$client->orders->destroy($newOrder['id']));
 
  }
}  
