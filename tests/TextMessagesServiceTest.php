<?php
namespace BaseCRM;

class TextMessagesServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }

  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->textMessages, 'all'));
  }

  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->textMessages, 'get'));
  }

  public function testAll()
  {
    $textMessages = self::$client->textMessages->all(['page' => 1]);
    $this->assertInternalType('array', $textMessages);

  }
}
