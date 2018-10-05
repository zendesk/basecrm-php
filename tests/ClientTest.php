<?php
namespace BaseCRM;

/**
 * @covers \BaseCRM\Client
 */
class ClientTest extends TestCase
{

  public function testAccountPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'accounts'));
  }

  public function testAssociatedContactPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'associatedContacts'));
  }

  public function testContactPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'contacts'));
  }

  public function testDealPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'deals'));
  }

  public function testDealSourcePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'dealSources'));
  }

  public function testDealUnqualifiedReasonPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'dealUnqualifiedReasons'));
  }

  public function testLeadPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'leads'));
  }

  public function testLeadSourcePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'leadSources'));
  }

  public function testLeadUnqualifiedReasonPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'leadUnqualifiedReasons'));
  }

  public function testLineItemPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'lineItems'));
  }

  public function testLossReasonPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'lossReasons'));
  }

  public function testNotePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'notes'));
  }

  public function testOrderPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'orders'));
  }

  public function testPipelinePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'pipelines'));
  }

  public function testProductPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'products'));
  }

  public function testSourcePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'sources'));
  }

  public function testStagePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'stages'));
  }

  public function testTagPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'tags'));
  }

  public function testTaskPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'tasks'));
  }

  public function testTextMessagePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'textMessages'));
  }

  public function testUserPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'users'));
  }

  public function testVisitPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'visits'));
  }

  public function testVisitOutcomePropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'visitOutcomes'));
  }

  public function testSyncPropertyExists()
  {
    $this->assertTrue(property_exists(self::$client, 'sync'));
  }
}
