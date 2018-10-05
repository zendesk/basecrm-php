<?php
namespace BaseCRM;

class VisitOutcomesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->visitOutcomes, 'all'));
  }

  public function testAll()
  {
    $visitOutcomes = self::$client->visitOutcomes->all(['page' => 1]);
    $this->assertInternalType('array', $visitOutcomes);
 
  }
}  
