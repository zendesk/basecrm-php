<?php
namespace BaseCRM;

class UsersServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->users, 'all'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->users, 'get'));
  }
  
  public function testSelfMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->users, 'self'));
  }

  public function testAll()
  {
    $has_more = null;
    $users    = self::$client->users->all(['page' => 1], $has_more);
    $this->assertInternalType('array', $users);
    $this->assertNotNull( $has_more, '$has_more flag not modified' ); 
  }

  public function testGet()
  {
    $foundUser = self::$client->users->get(self::$user['id']);
    $this->assertInternalType('array', $foundUser);
    $this->assertEquals($foundUser['id'], self::$user['id']); 
  }

  public function testSelf()
  {
    $resource = self::$client->users->self();
    $this->assertInternalType('array', $resource); 
  }
}  
