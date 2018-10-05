<?php
namespace BaseCRM;

class VisitsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->visits, 'all'));
  }

  public function testAll()
  {
    $visits = self::$client->visits->all(['page' => 1]);
    $this->assertInternalType('array', $visits);
 
  }
}  
