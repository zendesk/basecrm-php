<?php
namespace BaseCRM;

class AssociatedContactsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->associatedContacts, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->associatedContacts, 'create'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->associatedContacts, 'destroy'));
  }

  public function testAll()
  {
    $has_more           = null;
    $associatedContacts = self::$client->associatedContacts->all(self::$associatedContact['deal_id'], ['page' => 1], $has_more);
    $this->assertInternalType('array', $associatedContacts);
    $this->assertNotNull( $has_more, '$has_more flag not modified' );
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$associatedContact);
    $this->assertGreaterThanOrEqual(1, count(self::$associatedContact)); 
  }

  public function testDestroy()
  {
    $newAssociatedContact = self::createAssociatedContact();
    $this->assertTrue(self::$client->associatedContacts->destroy($newAssociatedContact['deal_id'], $newAssociatedContact['contact_id'])); 
  }
}  
