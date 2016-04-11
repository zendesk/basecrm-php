<?php
namespace BaseCRM;

class PipelinesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->pipelines, 'all'));
  }

  public function testAll()
  {
    $has_more  = null;
    $pipelines = self::$client->pipelines->all(['page' => 1], $has_more);
    $this->assertInternalType('array', $pipelines);
    $this->assertNotNull( $has_more, '$has_more flag not modified' );
  }
}  
