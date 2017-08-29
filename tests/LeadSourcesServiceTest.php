<?php
namespace BaseCRM;

class LeadSourcesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadSources, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadSources, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadSources, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadSources, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadSources, 'destroy'));
  }

  public function testAll()
  {
    $leadSources = self::$client->leadSources->all(['page' => 1]);
    $this->assertInternalType('array', $leadSources);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$leadSource);
    $this->assertGreaterThanOrEqual(1, count(self::$leadSource));
 
  }

  public function testGet()
  {
    $foundLeadSource = self::$client->leadSources->get(self::$leadSource['id']);
    $this->assertInternalType('array', $foundLeadSource);
    $this->assertEquals($foundLeadSource['id'], self::$leadSource['id']);
 
  }

  public function testUpdate()
  {
    $updatedLeadSource = self::$client->leadSources->update(self::$leadSource['id'], self::$leadSource);
    $this->assertInternalType('array', $updatedLeadSource);
    $this->assertEquals($updatedLeadSource['id'], self::$leadSource['id']);
 
  }

  public function testDestroy()
  {
    $newLeadSource = self::createLeadSource();
    $this->assertTrue(self::$client->leadSources->destroy($newLeadSource['id']));
 
  }
}  
