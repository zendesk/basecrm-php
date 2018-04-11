<?php
namespace BaseCRM;

class DealUnqualifiedReasonsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealUnqualifiedReasons, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealUnqualifiedReasons, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealUnqualifiedReasons, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealUnqualifiedReasons, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealUnqualifiedReasons, 'destroy'));
  }

  public function testAll()
  {
    $dealUnqualifiedReasons = self::$client->dealUnqualifiedReasons->all(['page' => 1]);
    $this->assertInternalType('array', $dealUnqualifiedReasons);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$dealUnqualifiedReason);
    $this->assertGreaterThanOrEqual(1, count(self::$dealUnqualifiedReason));
 
  }

  public function testGet()
  {
    $foundDealUnqualifiedReason = self::$client->dealUnqualifiedReasons->get(self::$dealUnqualifiedReason['id']);
    $this->assertInternalType('array', $foundDealUnqualifiedReason);
    $this->assertEquals($foundDealUnqualifiedReason['id'], self::$dealUnqualifiedReason['id']);
 
  }

  public function testUpdate()
  {
    $updatedDealUnqualifiedReason = self::$client->dealUnqualifiedReasons->update(self::$dealUnqualifiedReason['id'], self::$dealUnqualifiedReason);
    $this->assertInternalType('array', $updatedDealUnqualifiedReason);
    $this->assertEquals($updatedDealUnqualifiedReason['id'], self::$dealUnqualifiedReason['id']);
 
  }

  public function testDestroy()
  {
    $newDealUnqualifiedReason = self::createDealUnqualifiedReason();
    $this->assertTrue(self::$client->dealUnqualifiedReasons->destroy($newDealUnqualifiedReason['id']));
 
  }
}  
