<?php
namespace BaseCRM;

use Exception;

/**
 * Parent class for every test case.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
  protected static $accessToken = null;
  protected static $baseUrl = null;
  protected static $client = null;

  protected static $account = null;
  protected static $associatedContact = null;
  protected static $contact = null;
  protected static $deal = null;
  protected static $dealSource = null;
  protected static $dealUnqualifiedReason = null;
  protected static $lead = null;
  protected static $leadSource = null;
  protected static $leadUnqualifiedReason = null;
  protected static $lineItem = null;
  protected static $lossReason = null;
  protected static $note = null;
  protected static $order = null;
  protected static $product = null;
  protected static $source = null;
  protected static $tag = null;
  protected static $task = null;
  protected static $user = null;

  public static function setUpBeforeClass()
  {
    self::$accessToken = self::getAccessToken();
    self::$baseUrl = self::getBaseUrl();
    self::$client = new Client([
      'accessToken' => self::$accessToken,
      'baseUrl' => self::$baseUrl,
      'userAgent' => "BaseCRM/v2 PHP/" . Configuration::VERSION . '+tests',
      'verbose' => true,
    ]);

    self::$account = self::$client->accounts->self();
    self::$associatedContact = self::createAssociatedContact();
    self::$contact = self::createContact();
    self::$deal = self::createDeal();
    self::$dealSource = self::createDealSource();
    self::$dealUnqualifiedReason = self::createDealUnqualifiedReason();
    self::$lead = self::createLead();
    self::$leadSource = self::createLeadSource();
    self::$lineItem = self::createLineItem();
    self::$lossReason = self::createLossReason();
    self::$note = self::createNote();
    self::$order = self::createOrder();
    self::$product = self::createProduct();
    self::$source = self::createSource();
    self::$tag = self::createTag();
    self::$task = self::createTask();
    self::$user = self::$client->users->self();
  }

  /**
   * @ignore
   */
  protected static function getAccessToken()
  {
    $token = getenv("BASECRM_ACCESS_TOKEN");
    if (!$token) throw new Exception('"BASECRM_ACCESS_TOKEN" environment variable has not been found.');
    return $token;
  }

  protected static function getBaseUrl()
  {
    $url = getenv("BASECRM_BASE_URL");
    if(!$url) $url = "https://api.getbase.com";
    return $url;
  }

  protected static function createAssociatedContact(array $attributes = [])
  {
    $deal_id = self::createDeal()['id'];
    $associatedContact = [
      'role' => "involved",
      'contact_id' => self::createContact()['id'],
    ];
    $associatedContact = self::$client->associatedContacts->create($deal_id, array_merge($associatedContact, $attributes));

    $associatedContact['deal_id'] = $deal_id;
    return $associatedContact;
  }

  protected static function createContact(array $attributes = [])
  {
    $contact = [
      'description' => "I know him via Tom",
      'email' => "mark" . rand() . "@designservices.com",
      'facebook' => "mjohnson",
      'fax' => "+44-208-1234567",
      'first_name' => 'Mark' . rand(),
      'industry' => "Design Services",
      'is_organization' => false,
      'last_name' => 'Johnson' . rand(),
      'linkedin' => "mjohnson",
      'mobile' => "508-778-6516",
      'name' => 'Design Services Company' . rand(),
      'phone' => "508-778-6516",
      'skype' => "mjohnson",
      'tags' => ["important"],
      'title' => "CEO",
      'twitter' => "mjohnson",
      'website' => "www.designservices.com",
    ];
    $contact = self::$client->contacts->create(array_merge($contact, $attributes));

    return $contact;
  }

  protected static function createDeal(array $attributes = [])
  {
    $deal = [
      'currency' => "EUR",
      'dropbox_email' => "dropbox@4e627bcd.deals.futuresimple.com",
      'hot' => true,
      'name' => 'Website Redesign' . rand(),
      'tags' => ["important"],
      'value' => 1000,
      'contact_id' => self::createContact()['id'],
    ];
    $deal = self::$client->deals->create(array_merge($deal, $attributes));

    return $deal;
  }

  protected static function createDealWithDecimalValue(array $attributes = [])
  {
    $deal = [
      'currency' => "EUR",
      'dropbox_email' => "dropbox@4e627bcd.deals.futuresimple.com",
      'hot' => true,
      'name' => 'Website Redesign with decimal value' . rand(),
      'tags' => ["important"],
      'value' => "11.12",
      'contact_id' => self::createContact()['id'],
    ];

    $originalClient = self::$client;
    self::$client = ""; #$this->getMock('\BaseCRM\Client');

    $deal = self::$client->deals->create(array_merge($deal, $attributes));

    return $deal;
  }

  protected static function createDealSource(array $attributes = [])
  {
    $dealSource = [
      'name' => 'inbound marketing' . rand(),
      'resource_type' => 'deal'
    ];
    $dealSource = self::$client->dealSources->create(array_merge($dealSource, $attributes));

    return $dealSource;
  }

  protected static function createDealUnqualifiedReason(array $attributes = [])
  {
    $dealUnqualifiedReason = [
      'name' => 'Reason of unqualifying deal' . rand(),
    ];
    $dealUnqualifiedReason = self::$client->dealUnqualifiedReasons->create(array_merge($dealUnqualifiedReason, $attributes));

    return $dealUnqualifiedReason;
  }

  protected static function createLead(array $attributes = [])
  {
    $lead = [
      'description' => "I know him via Tom",
      'email' => "mark" . rand() . "@designservices.com",
      'facebook' => "mjohnson",
      'fax' => "+44-208-1234567",
      'first_name' => 'Mark' . rand(),
      'industry' => "Design Services",
      'last_name' => 'Johnson' . rand(),
      'linkedin' => "mjohnson",
      'mobile' => "508-778-6516",
      'phone' => "508-778-6516",
      'skype' => "mjohnson",
      'status' => "Unqualified",
      'tags' => ["important"],
      'title' => "CEO",
      'twitter' => "mjohnson",
      'website' => "www.designservices.com",
    ];
    $lead = self::$client->leads->create(array_merge($lead, $attributes));

    return $lead;
  }

  protected static function createLeadSource(array $attributes = [])
  {
    $leadSource = [
      'name' => 'outbound marketing' . rand(),
      'resource_type' => 'lead'
    ];
    $leadSource = self::$client->leadSources->create(array_merge($leadSource, $attributes));

    return $leadSource;
  }

  protected static function createLossReason(array $attributes = [])
  {
    $lossReason = [
      'name' => 'We were too expensive' . rand(),
    ];
    $lossReason = self::$client->lossReasons->create(array_merge($lossReason, $attributes));

    return $lossReason;
  }

  protected static function createLineItem(array $attributes = [])
  {
    $orderId = self::createOrder()['id'];
    $product = self::createProduct();

    $lineItem = [
      'product_id' => $product['id'],
      'currency' => 'USD',
      'variation' => '-19.99',
      'quantity' => 1,
      'value' => '80.00'
    ];
    $lineItem = self::$client->lineItems->create($orderId, array_merge($lineItem, $attributes));
    $lineItem['order_id'] = $orderId;

    return $lineItem;
}

  protected static function createNote(array $attributes = [])
  {
    $note = [
      'content' => "Highly important.",
      'resource_id' => self::createContact()['id'],
      'resource_type' => 'contact',
    ];
    $note = self::$client->notes->create(array_merge($note, $attributes));

    return $note;
  }

  protected static function createOrder(array $attributes = [])
  {
    $order = [
      'deal_id' => self::createDeal()['id'],
      'discount' => 20,
    ];
    $order = self::$client->orders->create(array_merge($order, $attributes));

    return $order;
  }

  protected static function createProduct(array $attributes = [])
  {
    $price = [
      'amount' => '99.99',
      'currency'=> 'USD'
    ];
    $product = [
      'name' => 'Product' . rand(),
      'description' => 'product description',
      'sku' => 'product-sku',
      'active' => true,
      'cost' => '99.99',
      'cost_currency' => 'USD',
      'max_discount' => 100,
      'max_markup' => 80,
      'prices' => [$price]
    ];
    $product = self::$client->products->create(array_merge($product, $attributes));

    return $product;
  }

  protected static function createSource(array $attributes = [])
  {
    $source = [
      'name' => 'Word of mouth' . rand(),
    ];
    $source = self::$client->sources->create(array_merge($source, $attributes));

    return $source;
  }

  protected static function createTag(array $attributes = [])
  {
    $tag = [
      'name' => 'publisher' . rand(),
      'resource_type' => 'contact',
    ];
    $tag = self::$client->tags->create(array_merge($tag, $attributes));

    return $tag;
  }

  protected static function createTask(array $attributes = [])
  {
    $task = [
      'content' => "Contact Tom",
      'due_date' => "2014-09-27T16:32:56+00:00",
      'remind_at' => "2014-09-29T15:32:56+00:00",
      'resource_id' => self::createContact()['id'],
      'resource_type' => 'contact',
    ];
    $task = self::$client->tasks->create(array_merge($task, $attributes));

    return $task;
  }
}
