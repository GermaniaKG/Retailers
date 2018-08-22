# Germania\Retailers

[![Build Status](https://travis-ci.org/GermaniaKG/Retailers.svg?branch=master)](https://travis-ci.org/GermaniaKG/Retailers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Retailers/build-status/master)


## Installation

```bash
$ composer require germania-kg/retailers
```


## Interfaces


### RetailerNumberProviderInterface

```php
public function getRetailerNumber()
```

### RetailerNumberAwareInterface

(formlery known as **RetailerNumberInterceptorsInterface** which will be removed with release 2.0)


```php
extends RetailerNumberProviderInterface
public function setRetailerNumber( $id )
```


## Traits


### RetailerNumberProviderTrait

Objects using this trait will provide a `retailer_number` attribute and a `getRetailerNumber` getter method, as outlined here:

```php
public $retailer_number;
public function getRetailerNumber()
```



### RetailerNumberAwareTrait

(formerly known as **RetailerNumberInterceptorsTrait** which will be removed with release 2.0))

Objects using this trait will provide anything that **RetailerNumberProviderInterface** provides, and additionally a setter method `setRetailerNumber` which accepts anything; if **RetailerNumberProviderInterface** given here, *getRetailerNumber* method will be called to obtain the ID to use. Roughly outlined:

```php
use RetailerNumberProviderTrait;
public function setRetailerNumber( $id )
```



## Examples

```php
<?php
use Germania\Retailers\RetailerNumberProviderInterface;
use Germania\Retailers\RetailerNumberProviderTrait;

class Retailer implements RetailerNumberProviderInterface
{
	use RetailerNumberProviderTrait;
	
	public function __construct( $retailer_number )
	{
		$this->retailer_number = $retailer_number;
	}
}

$retailer = new Retailer( 99 );
echo $retailer->getRetailerNumber(); // 99
```

```php
<?php
use Germania\Retailers\RetailerNumberAwareInterface;
use Germania\Retailers\RetailerNumberAwareTrait;

class MyOrder implements RetailerNumberAwareInterface
{
	use RetailerNumberAwareTrait;
}

$order = new MyOrder;
$order->setRetailerNumber( 34 );
echo $order->getRetailerNumber(); // 34
```



## RetailerFilterIterator


The **RetailerFilterIterator** class accepts any *Iterator* collection and a retailer ID (or ID array) or *RetailerNumberProviderInterface* instance to filter for. Collection items not being an instance of *RetailerNumberProviderInterface* are always ignored. 

**Iterator:**

- instances of *RetailerNumberProviderInterface*


**Filter values:**

- Integer or string ID
- Array of integer or string IDs
- One instance of *RetailerNumberProviderInterface* – also see [issue #1][i1]


**Example:**

```php
<?php
use Germania\Retailers\RetailerFilterIterator;

// Prepare some RetailerNumberProviderInterface instances:
$order1 = new MyOrder; 
$order1->setRetailerNumber( 1 );

$order2 = new MyOrder; 
$order2->setRetailerNumber( 20 );

$order3 = new MyOrder; 
$order4->setRetailerNumber( 999 );

$orders = [
	$order1,
	$order2,	
	$order3
];


// ---------------------------------------
// Filter by ID or ID array:
// ---------------------------------------

// should be '1'
$filter = new RetailerFilterIterator( new \ArrayIterator( $orders ) , 20);
echo iterator_count($filter);

// should be '2'
$filter = new RetailerFilterIterator( new \ArrayIterator( $orders ), array(20, 999));
echo iterator_count($filter);


// ---------------------------------------
// Filter by RetailerNumberProviderInterface:
// ---------------------------------------

$retailer = new Retailer( 1 );
$filter = new RetailerFilterIterator( new \ArrayIterator( $orders ), $retailer);

// should be '1'
echo iterator_count($filter);
```

## Roadmap

**Version 2:** 

- *RetailerNumberInterceptorsInterface* and *RetailerNumberInterceptorsTrait* will be removed.
- PHP 7.1+ required

## Issues

- The *RetailerFilterIterator* should also accept an array of *RetailerNumberProviderInterface* instances as filter value. See [issue #1][i1].


See [full issues list.][i0]

[i0]: https://github.com/GermaniaKG/Retailers/issues
[i1]: https://github.com/GermaniaKG/Retailers/issues/1


## Development

```bash
$ git clone https://github.com/GermaniaKG/Retailers.git
$ cd Retailers.git
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. 
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```


