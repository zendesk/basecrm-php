<?php
namespace BaseCRM;

class LineItemsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->lineItems, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->lineItems, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->lineItems, 'get'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->lineItems, 'destroy'));
  }

  public function testAll()
  {
    $lineItems = self::$client->lineItems->all(self::$lineItem['order_id'], ['page' => 1]);
    $this->assertInternalType('array', $lineItems);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$lineItem);
    $this->assertGreaterThanOrEqual(1, count(self::$lineItem));
 
  }

  public function testGet()
  {
    $foundLineItem = self::$client->lineItems->get(self::$lineItem['order_id'], self::$lineItem['id']);
    $this->assertInternalType('array', $foundLineItem);
    $this->assertEquals($foundLineItem['id'], self::$lineItem['id']);
 
  }

  public function testDestroy()
  {
    $newLineItem = self::createLineItem();
    $this->assertTrue(self::$client->lineItems->destroy($newLineItem['order_id'], $newLineItem['id']));
 
  }
}  
