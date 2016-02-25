<?php
namespace BaseCRM;

class DecimalDealValuesTest extends TestCase
{
  public function setup()
  {
    parent::setup();
  }

  public function testCreate()
  {
    $createdDeal = self::createDealWithDecimalValue();
    $this->assertEquals($createdDeal["value"], 11.12);
  }

  public function testUpdate()
  {
    $createdDeal = self::createDealWithDecimalValue();
    $createdDeal['value']++;

    $updatedDeal = self::$client->deals->update($createdDeal['id'], $createdDeal);
    $this->assertEquals($updatedDeal['value'], 12.12);
  }
}
