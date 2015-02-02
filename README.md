# Base CRM API client, PHP edition

A PHP client for the Base REST API.

Current state:

First release, Contacts and Leads API covered.

### Installing via Composer

The recommended way to install the client is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Guzzle:

```bash
composer require basecrm/basecrm-php
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

### Installing directly

In the `dist/` folder, there's a drop-in version, that you can just download and require.

## Usage
--------------------

To use the client, you need to instantiate a `\BaseCrm\Client` object.

```php
$client = new \BaseCrm\Client(['token' => 'YOUR API TOKEN']);
```

Afterwards, you call methods on a client to use the API.

Every call returns a `\BaseCrm\Response` object, which holds two properties:

`code` - the response HTTP status code
`data` - parsed JSON of the response, returnes as stdObject or array of stdObjects.

### Contacts

To access contacts, access the `contacts` property on the client, which will return a `\BaseCrm\Scope` connected to Contacts.

```php
$scope = $client->contacts
```

### Deals

To access deals, access the `contacts` property on the client, which will return a `\BaseCrm\Scope` connected to Deals.

```php
$scope = $client->deals
```

### Leads

To access deals, access the `contacts` property on the client, which will return a `\BaseCrm\Scope` connected to Leads.

```php
$scope = $client->leads
```

## Scope

Every time you have a scope, you can perform the following methods on it:

#### #all

Retrieve a list of resources

```php
$scope->all()
```

This returns a `\BaseCrm\Response` with an array of Resource stdObjects in the `data` property.

#### #get

Retrieve a single resource.

```php
$scope->get($id)
```

`$id` is the id of the resource.

This returns a `\BaseCrm\Response` with a Resource stdObject in the `$data` property.

#### #create

Create a single resource.

```php
$scope->create($params)
```

`$params` is an associative array with fields of the resource.

This returns a `\BaseCrm\Response` with a newly created Resource stdObject in the `$data` property.

#### #update

Update a single resource.

```php
$scope->update($id, $params)
```

`$id` is the id of the resource to update.

`$params` is an associative array with fields of the resource.

This returns a `\BaseCrm\Response` with an update Resource stdObject in the `$data` property.

#### #destroy

Destroy a single resource.

```php
$scope->destroy($id)
```

`$id` is the id of the resource.

This returns a `\BaseCrm\Response` with a 200 response code in the `$code` property.

## Examples

### Create a lead

```php
$client->leads->create([
  "last_name" => "Johnson",
  "first_name" => "Mark",
  "company_name" => "Acme"
]);
```

### Create a contact

```php
$client->contacts->create([
  "last_name" => "Johnson",
  "first_name" => "Mark"
]);
```

Copyright
---------

Copyright (c) 2015 Marcin Bunsch, Base CRM. See LICENSE for details.

