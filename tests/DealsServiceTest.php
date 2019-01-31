<?php
namespace BaseCRM;

class DealsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->deals, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->deals, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->deals, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->deals, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->deals, 'destroy'));
  }

  public function testAll()
  {
    $deals = self::$client->deals->all(['page' => 1]);
    $this->assertInternalType('array', $deals);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$deal);
    $this->assertGreaterThanOrEqual(1, count(self::$deal));
 
  }

  public function testGet()
  {
    $foundDeal = self::$client->deals->get(self::$deal['id']);
    $this->assertInternalType('array', $foundDeal);
    $this->assertEquals($foundDeal['id'], self::$deal['id']);
 
  }

  public function testUpdate()
  {
    $updatedDeal = self::$client->deals->update(self::$deal['id'], self::$deal);
    $this->assertInternalType('array', $updatedDeal);
    $this->assertEquals($updatedDeal['id'], self::$deal['id']);
 
  }

  public function testUpdateWithoutProvidingDealValue()
  {
      $initialDealValue = self::$deal['value'];
      unset(self::$deal['value']);
      $updatedDeal = self::$client->deals->update(self::$deal['id'], self::$deal);
      $this->assertInternalType('array', $updatedDeal);
      $this->assertEquals($updatedDeal['id'], self::$deal['id']);
      $this->assertEquals($updatedDeal['value'], $initialDealValue);
  }
  public function testCreateWithoutProvidingDealValue()
  {
      $dealPrototype = [
        "contact_id" => self::$contact['id'],
        "name" => "PHP Client Test Deal" 
      ];
      $createdDeal = self::$client->deals->create($dealPrototype);
      if(isset($createdDeal) && isset($createdDeal['id'])) {
        self::$client->deals->destroy($createdDeal['id']);
      }
      $this->assertEquals($createdDeal['value'], 0);
  }

  public function testDestroy()
  {
    $newDeal = self::createDeal();
    $this->assertTrue(self::$client->deals->destroy($newDeal['id']));
 
  }
}  
