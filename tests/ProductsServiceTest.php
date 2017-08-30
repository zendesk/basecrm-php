<?php
namespace BaseCRM;

class ProductsServiceTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }
  
  public function testAllMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->products, 'all'));
  }
  
  public function testCreateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->products, 'create'));
  }
  
  public function testGetMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->products, 'get'));
  }
  
  public function testUpdateMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->products, 'update'));
  }
  
  public function testDestroyMethodExists()
  {
    $this->assertTrue(method_exists(self::$client->products, 'destroy'));
  }

  public function testAll()
  {
    $products = self::$client->products->all(['page' => 1]);
    $this->assertInternalType('array', $products);
 
  }

  public function testCreate()
  {
    $this->assertInternalType('array', self::$product);
    $this->assertGreaterThanOrEqual(1, count(self::$product));
 
  }

  public function testGet()
  {
    $foundProduct = self::$client->products->get(self::$product['id']);
    $this->assertInternalType('array', $foundProduct);
    $this->assertEquals($foundProduct['id'], self::$product['id']);
 
  }

  public function testUpdate()
  {
    $updatedProduct = self::$client->products->update(self::$product['id'], self::$product);
    $this->assertInternalType('array', $updatedProduct);
    $this->assertEquals($updatedProduct['id'], self::$product['id']);
 
  }

  public function testDestroy()
  {
    $newProduct = self::createProduct();
    $this->assertTrue(self::$client->products->destroy($newProduct['id']));
 
  }
}  
