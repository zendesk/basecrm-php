<?php
namespace BaseCRM;

class StagesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->stages, 'all'));
  }

  public function testAll()
  {
    $has_more = null;
    $stages   = self::$client->stages->all(['page' => 1], $has_more);
    $this->assertInternalType('array', $stages);
    $this->assertNotNull( $has_more, '$has_more flag not modified' );
  }
}  
