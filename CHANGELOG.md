## CHANGELOG

### v1.3.3 (2018-06-05)

**Features and Improvements**
  * Added possibility to set deal's 'customized_win_likelihood', 'last_stage_change_at' attributes

### v1.3.2 (2018-04-11)

**Features and Improvements**
  * Support for resources: Deal Unqualified Reason, Lead Unqualified Reason

### v1.3.1 (2017-12-22)

**Features and Improvements**
  * Fixed issue where could not update deal without passing value

### v1.3.0 (2017-08-28)

**Features and Improvements**
  * Support for resources: Lead Source, Deal Source, Product, Order, Line Item

### v1.2.1 (2016-06-29)

**Bug Fixes**
* Fixed incorrect return in Deal Service

**Important:** Deal value type has been changed to float (since v1.2.0)

### v1.2.0 (2016-06-24)

**Features and Improvements**

* Support for decimal deal values [#15](https://github.com/basecrm/basecrm-php/pull/15)
* Deal values are now Floats [#15](https://github.com/basecrm/basecrm-php/pull/15)

### v1.1.2 (2016-02-26)

**Features and Improvements**

* Properly encode `\DateTime` objects [#8](https://github.com/basecrm/basecrm-php/pull/8)
* Properly encode boolean query parameters [#9](https://github.com/basecrm/basecrm-php/pull/9)
* `verifySSL` configuration option [#10](https://github.com/basecrm/basecrm-php/pull/10)
* All `private` attributes methods are now marked as `protected` [#6](https://github.com/basecrm/basecrm-php/pull/6)
* README updates
  * Usage examples syntax fixes [#5](https://github.com/basecrm/basecrm-php/pull/5)
  * Improve the phpunit command line example [#7](https://github.com/basecrm/basecrm-php/pull/7)

### v1.1.1 (2015-11-03)

**Improvements**

* `\BaseCRM\LeadsService` allows to set `source_id`
* `\BaseCRM\DealsService` allows to set `estimated_close_date`

### v1.1.0 (2015-06-01)

**Features and Improvements**

* `\BaseCRM\HttpClient` methods accept additional `$options`
* Sync API support
  * New low-level`\BaseCRM\SyncService`
  * High-level `\BaseCRM\Sync` wrapper

### v1.0.0 (2015-04-22)

* Birth!
