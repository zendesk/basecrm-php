<?php
namespace BaseCRM;

class DealSourcesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealSources, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealSources, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealSources, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealSources, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->dealSources, 'destroy'));
  }

  public function testAll()
  {
    $dealSources = self::$client->dealSources->all(['page' => 1]);
    $this->assertInternalType('array', $dealSources);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$dealSource);
    $this->assertGreaterThanOrEqual(1, count(self::$dealSource));
 
  }

  public function testGet()
  {
    $foundDealSource = self::$client->dealSources->get(self::$dealSource['id']);
    $this->assertInternalType('array', $foundDealSource);
    $this->assertEquals($foundDealSource['id'], self::$dealSource['id']);
 
  }

  public function testUpdate()
  {
    $updatedDealSource = self::$client->dealSources->update(self::$dealSource['id'], self::$dealSource);
    $this->assertInternalType('array', $updatedDealSource);
    $this->assertEquals($updatedDealSource['id'], self::$dealSource['id']);
 
  }

  public function testDestroy()
  {
    $newDealSource = self::createDealSource();
    $this->assertTrue(self::$client->dealSources->destroy($newDealSource['id']));
 
  }
}  
