<?php
namespace BaseCRM;

class LeadUnqualifiedReasonsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->leadUnqualifiedReasons, 'all'));
  }

  public function testAll()
  {
    $leadUnqualifiedReasons = self::$client->leadUnqualifiedReasons->all(['page' => 1]);
    $this->assertInternalType('array', $leadUnqualifiedReasons);
 
  }
}  
